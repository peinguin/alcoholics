<!-- File: /app/View/Posts/add.ctp -->

<script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<?php echo $this->Html->script('place');?>
<h1>Add Event</h1>
<?php
echo $this->Form->create('Event');
echo $this->Form->input('title');
echo $this->Form->input('desc', array('rows' => '3'));
echo '<p class="row"><div id="mappy" style="width:400px; height:350px; border:1px solid #cecece; background:#F5F5F5"></div></p>';
echo $this->Form->hidden('lat', array('id' => 'lat'));
echo $this->Form->hidden('lng', array('id' => 'lng'));

echo $this->Form->end('New Event');
?>