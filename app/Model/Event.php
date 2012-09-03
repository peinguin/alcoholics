<?php
class Event extends AppModel {

	var $name = 'Event';
    var $primaryKey = '_id';
    var $useDbConfig = 'mongo';
 
    function schema($field = false) {
        $this->_schema = array(
            '_id' => array('type' => 'integer', 'primary' => true, 'length' => 40),
            'title' => array('type' => 'string', 'length' => 255),
            'desc' => array('type' => 'text'),
            'lat' => array('type' => 'String', 'length' => 255),
            'lng' => array('type' => 'String', 'length' => 255),
            'datetime' => array('type' => 'datetime'),
            'creator' => array('type' => 'integer', 'length' => 40)
        );
        return $this->_schema;
    }

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
    );

    public function isOwnedBy($event, $user) {
        return $this->field('_id', array('_id' => $event, 'creator' => $user)) === $event;
    }

}