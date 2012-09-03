<?php
// app/Model/User.php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    var $primaryKey = '_id';
    var $useDbConfig = 'mongo';

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    function schema($field = false) {
        $this->_schema = array(
            '_id' => array('type' => 'integer', 'primary' => true, 'length' => 40),
            'username' => array('type' => 'string', 'length' => 50),
            'password' => array('type' => 'string', 'length' => 50),
            'role' => array('type' => 'string', 'length' => 20),

            'created' => array('type' => 'datetime'),
            'modified' => array('type' => 'datetime'),
            'igo' => array(),
            '$push' =>array(),
        );
        return $this->_schema;
    }

    public function beforeSave($options = Array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}