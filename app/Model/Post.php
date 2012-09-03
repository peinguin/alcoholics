<?php
class Post extends AppModel {

	var $name = 'Post';
    var $primaryKey = '_id';
    var $useDbConfig = 'mongo';
 #   var $useTable = false;
 
    function schema() {
        $this->_schema = array(
            '_id' => array('type' => 'integer', 'primary' => true, 'length' => 40),
            'title' => array('type' => 'string', 'length' => 255),
            'body' => array('type' => 'text'),
            'created' => array('type' => 'datetime'),
            'modified' => array('type' => 'datetime')
        );
        return $this->_schema;
    }

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

}