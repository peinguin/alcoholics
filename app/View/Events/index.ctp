<?php
echo $this->Html->link('My Events', array(
	'controller' => 'events',
    'action' => 'my'
)); ?><br />
<?php
echo $this->Html->link('Other Events', array(
	'controller' => 'events',
    'action' => 'other',
)); ?>