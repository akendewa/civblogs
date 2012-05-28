<?php
/**
 * Controlleur pour les categories.
 *
 * Gere l'activite relative a l'administration des categories
 *
 * @copyright     Copyright 2012, Akendewa. (http://www.akendewa.org)
 * @author        Regis Bamba (regis.bamba@gmail.com)
 * @package       app.Controller
 * @since         v 0.1.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

    public function admin_index() {
        $this->Category->recursive = 0;
        $this->set('categories', $this->paginate());
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }
        $blogs = $this->Category->Blog->find('list');
        $this->set(compact('blogs'));
    }

    public function admin_edit($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Category->read(null, $id);
        }
        $blogs = $this->Category->Blog->find('list');
        $this->set(compact('blogs'));
    }

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('Category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
