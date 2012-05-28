<?php
/**
 * Controlleur pour les billets.
 *
 * Gere l'activite relative aux billets.
 *
 * @copyright     Copyright 2012, Akendewa. (http://www.akendewa.org)
 * @author        Regis Bamba (regis.bamba@gmail.com)
 * @package       app.Controller
 * @since         v 0.1.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');
App::uses('Tagged', 'Tags');

class PostsController extends AppController {

    public $uses = array('Blog', 'Post');
    public $helpers = array('Text', 'Time');
    public $paginate = array(
        'Post' => array(
            'conditions' => array('Post.is_active' => true),
            'limit' => 25,
            'order' => array(
                'Post.created' => 'desc'
            )
        )
    );

    public function search() {
        if (isset($this->request->params['named']['tag'])) {
            $tag = $this->Post->Tag->findByKeyname($this->request->params['named']['tag'], array('fields' => 'id', 'name'));
            $this->Post->bindModel(
                array(
                    'hasOne' => array(
                        'Tagged' => array(
                            'conditions' => array('model' => 'Post'),
                            'foreignKey' => 'foreign_key'
                        )
                    )
                ),
                false
            );
            $this->paginate['Post']['conditions'] =  array('Tagged.tag_id' => $tag['Tag']['id']);
            $this->paginate['Post']['contain'] = 'Tagged';
            $this->set('title_for_layout', 'Billets tagu&eacute;s "'.$tag['Tag']['name'].'"');
        } else if (isset($this->request->params['named']['category'])) {
            $category = $this->Blog->Category->findBySlug($this->request->params['named']['category'], array('fields' => 'id', 'name'));
            $this->Blog->bindModel(
                array(
                    'hasOne' => array(
                        'BlogsCategory'
                    )
                ),
                false
            );
            $blogsCategories = $this->Blog->BlogsCategory->find(
                'all',
                array(
                    'fields' => array('category_id', 'blog_id'),
                    'conditions' => array('category_id' => $category['Category']['id'])
                )
            );
            $blogIds = Array();
            foreach($blogsCategories as $bC) {
                $blogIds[] = $bC['BlogsCategory']['blog_id'];
            }

            $this->paginate['Post']['conditions'] =  array('Blog.id' => $blogIds);
            $this->set('title_for_layout', $category['Category']['name']);
        }
        $posts = $this->paginate('Post');
		$this->set(compact('posts'));
    }

    public function go($id) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
        $post = $this->Post->read(array('url', 'hits_count'));
        $newCount = $post['Post']['hits_count'] + 1;
        $this->Post->saveField('hits_count', $newCount);
        $this->redirect($post['Post']['url']);
    }

    public function admin_change_active_status($id, $redirectPage) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
        $post = $this->Post->read(array('is_active', 'Blog.id'), $id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
        $this->Post->saveField('is_active', !$post['Post']['is_active']);
        $this->redirect(array('action' => 'index', 'admin' => 'true', 'blog'=> $post['Blog']['id'], 'page' => $redirectPage, '#' => $id));
	}

    public function admin_fetch_preview($id, $redirectPage) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
        $post = $this->Post->read(array('url', 'Blog.id'), $id);

		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
        App::uses('HttpSocket', 'Network/Http');
        $HttpSocket = new HttpSocket();

        $results = $HttpSocket->get('http://api.embed.ly/1/oembed',
            array(
                'key' => Configure::read('Embedly.Key'),
                'url' => $post['Post']['url'],
                'format' => 'xml',
            )
        );
        if (isset($results->code) && $results->code == '200') {
            $xmlObject = Xml::build($results->body);
            $data = Xml::toArray($xmlObject);
            $this->Post->id = $id;
            if (isset($data['oembed']['description'])) {
                $this->Post->saveField('description', $data['oembed']['description']);
            }
            if (isset($data['oembed']['thumbnail_url'])) {
                $this->Post->saveField('image_url', $data['oembed']['thumbnail_url']);
            }
            $this->Session->setFlash(__('Preview Fetched', true), 'default', array('class' => 'alert alert-success'));
        }
        $this->redirect(array('action' => 'index', 'admin' => 'true', 'blog'=> $post['Blog']['id'], 'page' => $redirectPage, '#' => $id));
    }


	public function admin_index() {
		$this->Post->recursive = 0;
        if (isset($this->request->params['named']['blog'])) {
            $this->paginate['Post']['conditions']['Blog.id'] = $this->request->params['named']['blog']; 
        }
		$this->set('posts', $this->paginate('Post'));
	}

	public function admin_edit($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Post->read(null, $id);
		}
		$blogs = $this->Post->Blog->find('list');
		$tags = $this->Post->Tag->find('list');
		$this->set(compact('blogs', 'tags'));
	}

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('Post deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Post was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
