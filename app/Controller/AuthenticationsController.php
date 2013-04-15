<?php
App::uses('AppController', 'Controller');
/**
 * Authentications Controller
 *
 * @property Authentication $Authentication
 */
class AuthenticationsController extends AppController {

	
	public function isAuthorized($user) {
		// Only admins can access this table
		if ( $user['role'] != 'admin' ) {
			$this->Session->setFlash(__('Only admins may access authentications'));
			return false;
		}
		return true;
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Authentication->recursive = 0;
		$this->set('authentications', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Authentication->exists($id)) {
			throw new NotFoundException(__('Invalid authentication'));
		}
		$options = array('conditions' => array('Authentication.' . $this->Authentication->primaryKey => $id));
		$this->set('authentication', $this->Authentication->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Authentication->create();
			if ($this->Authentication->save($this->request->data)) {
				$this->Session->setFlash(__('The authentication has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The authentication could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Authentication->exists($id)) {
			throw new NotFoundException(__('Invalid authentication'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Authentication->save($this->request->data)) {
				$this->Session->setFlash(__('The authentication has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The authentication could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Authentication.' . $this->Authentication->primaryKey => $id));
			$this->request->data = $this->Authentication->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Authentication->id = $id;
		if (!$this->Authentication->exists()) {
			throw new NotFoundException(__('Invalid authentication'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Authentication->delete()) {
			$this->Session->setFlash(__('Authentication deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Authentication was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Authentication->recursive = 0;
		$this->set('authentications', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Authentication->exists($id)) {
			throw new NotFoundException(__('Invalid authentication'));
		}
		$options = array('conditions' => array('Authentication.' . $this->Authentication->primaryKey => $id));
		$this->set('authentication', $this->Authentication->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Authentication->create();
			if ($this->Authentication->save($this->request->data)) {
				$this->Session->setFlash(__('The authentication has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The authentication could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Authentication->exists($id)) {
			throw new NotFoundException(__('Invalid authentication'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Authentication->save($this->request->data)) {
				$this->Session->setFlash(__('The authentication has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The authentication could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Authentication.' . $this->Authentication->primaryKey => $id));
			$this->request->data = $this->Authentication->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Authentication->id = $id;
		if (!$this->Authentication->exists()) {
			throw new NotFoundException(__('Invalid authentication'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Authentication->delete()) {
			$this->Session->setFlash(__('Authentication deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Authentication was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
