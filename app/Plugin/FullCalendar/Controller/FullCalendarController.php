<?php
/*
 * Controller/FullCalendarController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
 
class FullCalendarController extends FullCalendarAppController {

	var $name = 'FullCalendar';
	
	public function beforeFilter() {
		parent::beforeFilter();
		// Allow visitors to view houses
		Configure::write('Config.language', 'de');
		$this->Session->write('menue.active','FullCalendar');
	}
	
	public function isAuthorized($logged_user) {
	
		return TRUE;
	
		return parent::isAuthorized($logged_user);
	}
	
	
	function index() {
	}

}
?>
