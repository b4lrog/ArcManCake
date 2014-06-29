<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author elgatil
 */

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{
    
	public $hasMany = array(
			'MyCostumer' => array(
					'className' => 'Costumer',
					'foreignKey' => 'user_id'
			),
			'MyProposal' => array(
					'className' => 'Proposal',
					'foreignKey' => 'user_id'
			)
	);

	
    public $validate=array(
	'username'=>array(
            'required'=>array(
                'rule'=>array('notEmpty'),
                'message'=> 'A username is required'
                )
	),
        'password'=>array(
            'required'=>array(
                'rule'=>array('notEmpty'),
                'message'=> 'A password is required'
            )
	),
        'role'=>array(
            'valid'=>array(
                #'rule'=>array('inList',array('admin','owner','employee','visitor')),
            	'rule'=>array('inList',array(0,1,2,3)),
                'message'=> 'Please enter a valid role',
                'allowEmpty'=>false
            )
	)
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
                );
        }
        return TRUE;
    }
    

    
}
