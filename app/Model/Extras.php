<?php

class Floorplan extends AppModel{
	
	public $belongsTo = array(
			'MyCategory' => array(
					'className' => 'Category',
					'foreignKey' => 'category_id'
			),
			'MyUser' => array(
					'className' => 'User',
					'foreignKey' => 'user_id'
			)
	);
	
	public $hasMany = array(
			'MyBoughtExtras' => array(
					'className' => 'BoughtExtra',
					'foreignKey' => 'extra_id'
			)
	);
	
	
    public $validate=array(
    		'name'=>array('rule'=>'notEmpty'),
   	 		'default_price'=>array(
            	'rule'=>'decimal',
    			'message'=> 'Please enter a valid price',
    			'allowEmpty'=>false
			)
    );
    

}
