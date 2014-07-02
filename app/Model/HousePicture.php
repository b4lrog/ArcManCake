<?php

class HousePicture extends AppModel{
	
	public $belongsTo = array(
			'MyUser' => array(
					'className' => 'User',
					'foreignKey' => 'user_id'
			)
	);
	
	
    public $validate=array(
    		'name'=>array('rule'=>'notEmpty'),
    		'upload'=>array(
            	'rule'=>'uploadError',
    			'message'=> 'Something went wrong while updating',
    			'allowEmpty'=>false
			),
    		'house'=>array(
    			'rule'=>'notEmpty',
            	'message'=> 'Please enter a valid house'
    		)
    );
    

}
