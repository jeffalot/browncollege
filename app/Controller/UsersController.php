<?php
App::uses('AppController', 'Controller');
// app/Controller/UsersController.php
class UsersController extends AppController {

	// app/Controller/UsersController.php
	
	public $paginate = array(
			'limit' => 500,
			'order' => array(
					'User.name' => 'asc'
			)
	);

	
	public function netbadge() {
		if ( !isset($_COOKIE['REMOTE_AUTH']) ) {
			$this->Session->setFlash(__('This only works with netbadge (aka pubcookie).'));
			$this->redirect($this->Auth->redirect()); // somewhere else…
		}
		$uniqid = $_COOKIE['REMOTE_AUTH'];
		setcookie("REMOTE_AUTH","",0,"/~energy");
	
		$search = $this->User->Authentication->find('first', array('conditions'=>array('value'=>$uniqid,'valid'=>1)));
		$this->set('who',$search['User']['username']);
		// log in user
		if ($this->Auth->login($search['User']))
			$this->Session->setFlash(__('Successful netbadge login'));
		else
			$this->Session->setFlash(__('Something went wrong with netbage…'));
		$this->redirect($this->Auth->redirect());
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('people', "active");
		$this->Auth->allow('login', 'logout', 'netbadge'); // Letting users register themselves
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	public function index() {
		$this->layout = 'default';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}