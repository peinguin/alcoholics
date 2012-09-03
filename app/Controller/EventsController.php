<?php
class EventsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('User', 'Event');

    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('add', 'my', 'other', 'igo', 'who'))) {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $eventId = $this->request->params['pass'][0];
            if ($this->Event->isOwnedBy($eventId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        
    }

    public function igo($id = null){
        $this->Event->id = $id;

        $users = $this->User->find('all', array('conditions'=>array('_id' => $this->Auth->user('_id'), 'igo' => $id)));
#        
#debug($users);die;

        if(count($users) == 0){
            $res = $this->User->save(array('_id' =>  $this->Auth->user('_id'), '$push' => array('igo' => $id)));
         
        }else{
            $this->Session->setFlash('Your already going.');
        }
        
        if ($res) {
            $this->Session->setFlash('Your going to this event.');
            $this->redirect(array('action' => 'index'));
        }else{
            $this->Session->setFlash('You already witer for this event');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function my(){
    	$this->set('events', $this->Event->find(
            'all',
            array(
                'conditions' => array(
                    'creator' => $this->Auth->user('_id')
                )
            )
        ));
    }

    public function who($id = null){
        $this->set('users', $this->User->find(
            'all',
            array(
                'conditions' => array(
                    'igo' => $id
                )
            )
        ));
    }

    public function other(){
        $this->set('events', $this->Event->find(
            'all',
            array(
                'conditions' => array(
                    'creator' => array('$ne' => $this->Auth->user('_id'))
                )
            )
        ));
    }

    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Event']['creator'] = $this->Auth->user('_id');
        	$resp = $this->Event->save($this->request->data);
        	
            if ($resp) {
                $this->Session->setFlash('Your event has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }

    public function edit($id = null) {
	    $this->Post->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Post->read();
	    } else {
	        if ($this->Post->save($this->request->data)) {
	            $this->Session->setFlash('Your post has been updated.');
	            $this->redirect(array('action' => 'index'));
	        } else {
	            $this->Session->setFlash('Unable to update your post.');
	        }
	    }
	}

	public function delete($id = null) {

	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Post->delete($id)) {
	        $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}