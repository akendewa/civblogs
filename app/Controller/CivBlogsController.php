<?php
/**
 * Controlleur pour les blogues.
 *
 * Gere l'activite relative aux blogues.
 *
 * @copyright     Copyright 2012, Akendewa. (http://www.akendewa.org)
 * @author        Regis Bamba (regis.bamba@gmail.com)
 * @package       app.Controller
 * @since         v 0.1.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

class BlogsController extends AppController {

    public $uses = array('Blog', 'Post', 'Tag', 'Category');
    public $helpers = array('Time', 'Text');
    
    public $paginate = array(
        'Blog' => array(
            'order' => 'Blog.created DESC'
        ),
        'Post' => array(
            'order' => 'Post.created DESC',
            'conditions' => array('Post.is_active' => true)
        )
    );

	public function add() {
        $this->set('title_for_layout', __('Suggest a blog'));
		if ($this->request->is('post')) {
            $blog['Blog']['posts_count'] = 0;
            $this->request->data['Blog']['is_active'] = false;
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('Thanks for your suggestion'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('controller' => 'application', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
			}
		}
	}
    
	public function view($url) {
        $blog = $this->Blog->findByUrl($url);
		if (!$blog || !$blog['Blog']['is_active']) {
			throw new NotFoundException(__('Invalid blog'));
		}
        $this->paginate['Post']['limit'] = 10;
        $this->paginate['Post']['conditions']['Blog.id'] = $blog['Blog']['id'];
        $posts = $this->paginate('Post');
        $this->set('title_for_layout', $blog['Blog']['name']);           
		$this->set(compact('blog', 'posts'));
	}

	public function admin_index() {
		$this->Blog->recursive = 0;
		$this->set('blogs', $this->paginate('Blog'));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid blog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Blog->read(null, $id);
		}
        $categories = $this->Category->find('list');
        $this->set(compact('categories'));
	}

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid blog'));
		}
		if ($this->Blog->delete()) {
			$this->Session->setFlash(__('Blog deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Blog was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function admin_fetch_rss_feed($id, $redirectPage) {

		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

        $this->Blog->recursive = 0;
        $blog = $this->Blog->findById($id, array('feed'));

        if ($blog) {
            App::uses('CakeTime', 'Utility');    
            App::import('Vendor', 'simplepie');

            $feed = new SimplePie();
            $feed->set_feed_url('http://'.$blog['Blog']['feed']);
            $feed->enable_cache(false);
            $feed->init();
            $items = $feed->get_items();
            $savedPostsCount = 0;
            foreach($items as $item) {
                $postCheck = $this->Post->findByUrl($item->get_link(), array('id'));
                if (!$postCheck) {
                    $post = Array();
                    $post['Post']['title'] = $item->get_title();
                    $post['Post']['url'] = $item->get_link();
                    $post['Post']['blog_id'] = $blogId;
                    $post['Post']['is_active'] = false;
                    $post['Post']['hits_count'] = 0;
                    $post['Post']['created'] = CakeTime::format('Y-m-d H:i:s', $item->get_date());

                    $categories = $item->get_categories();
                    $tags = Array();

                    if (is_array($categories)) {
                        foreach ($categories as $category) {
                            if ($category->get_label() != null) {
                                $tags[] = $category->get_label();
                            } else if ($category->get_term() != null) {
                                $tags[] = $category->get_term();
                            }
                        }
                    }

                    $post['Post']['tags'] = String::toList($tags, $and=',');
                    $this->Post->create();
                    if ($this->Post->save($post)) {
                        $savedPostsCount++;
                    }
                    unset($post);
                }
                unset($postCheck);
            }
            $postsCount = $this->Post->find('count', array('conditions' => array('blog_id' => $id)));
            $blog['Blog']['posts_count'] = $postsCount;
            $this->Blog->id = $id;
            $this->Blog->saveField('posts_count', $postsCount);
            $this->Session->setFlash('Number of items retrieved : '.$savedPostsCount, 'default', array('class' => 'alert alert-success'));
        }
        $this->redirect(array('controller' => 'blogs', 'action' => 'index', 'admin' => true, 'page' => $redirectPage, '#' => $id));
    }
}
