<?php
/*
 * Controller/EventsController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

class EventsController extends FullCalendarAppController {

	var $name = 'Events';

	var $paginate = array(
		'limit' => 15
	);
	
	
	public function isAuthorized($logged_user) {
		if (!empty($logged_user['role']) ){
			return true;
		}
		return parent::isAuthorized($logged_user);
	}
	

	function index() {
		$this->Event->recursive = 1;
		$this->set('events', $this->paginate());
		$this->set('list_users_view',$this->Event->MyUser->find('list',array('fields'=>array('id','username'))));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('event', $this->Event->read(null, $id));
		
		$this->set('list_users_view',$this->Event->MyUser->find('list',array('fields'=>array('id','username'))));
	}

	function add() {
		if ($this->request->is('post')) {
			$this->Event->create();
			$this->request->data['Event']['user_id']=$this->Auth->user('id');
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'), 'alert-box', array('class'=>'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'), 'alert-box', array('class'=>'alert-danger'));
			}
		}
		$this->set('eventTypes', $this->Event->EventType->find('list'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event.'), 'alert-box', array('class'=>'alert-danger'));
			$this->redirect(array('action' => 'index'));
		}
		$x = $this->Event->findById($id);
		if($x['Event']['user_id']!=$this->Auth->user('id')){
			$this->Session->setFlash(__('This appointment is not yours.'), 'alert-box', array('class'=>'alert-danger'));
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->request->is(array('Event','put'))) {
			$this->Event->id = $id;
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'), 'alert-box', array('class'=>'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'), 'alert-box', array('class'=>'alert-danger'));
			}
		}
		
		if (!$this->request->data) {
			$this->request->data=$x;
		}
		$this->set('eventTypes', $this->Event->EventType->find('list'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid event.'), 'alert-box', array('class'=>'alert-danger'));
			$this->redirect(array('action'=>'index'));
		}
		
		$x = $this->Event->findById($id);
		if($x['Event']['user_id']!=$this->Auth->user('id')){
			$this->Session->setFlash(__('This appointment is not yours.'), 'alert-box', array('class'=>'alert-danger'));
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->Event->delete($id)) {
			$this->Session->setFlash(__('Event deleted.'), 'alert-box', array('class'=>'alert-success'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Event was not deleted.'), 'alert-box', array('class'=>'alert-danger'));
		$this->redirect(array('action' => 'index'));
	}

        // The feed action is called from "webroot/js/ready.js" to get the list of events (JSON)
	function feed($id=null) {
		$this->layout = "ajax";
		$vars = $this->params['url'];
		$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
		$events = $this->Event->find('all', $conditions);
		foreach($events as $event) {
			if($event['Event']['all_day'] == 1) {
				$allday = true;
				$end = $event['Event']['start'];
			} else {
				$allday = false;
				$end = $event['Event']['end'];
			}
			$data[] = array(
					'id' => $event['Event']['id'],
					'title'=>$event['Event']['title'],
					'start'=>$event['Event']['start'],
					'end' => $end,
					'allDay' => $allday,
					'url' => Router::url('/') . 'full_calendar/events/view/'.$event['Event']['id'],
					'details' => $event['Event']['details'],
					'className' => $event['EventType']['color']
			);
		}
		$this->set("json", json_encode($data));
	}

        // The update action is called from "webroot/js/ready.js" to update date/time when an event is dragged or resized
	function update() {
		$vars = $this->params['url'];
		$event=$this->Event->findById($vars['id']);
		if($event['Event']['user_id']==$this->Auth->user('id')){
			$this->Event->id = $vars['id'];
			$this->Event->saveField('start', $vars['start']);
			$this->Event->saveField('end', $vars['end']);
			$this->Event->saveField('all_day', $vars['allday']);
		}
	}

}
?>
