<?php
echo $this->Html->link('New event', array(
	'controller' => 'events',
    'action' => 'add'
)); ?><br />
<?php if(count($events)>0): ?>
<table>
	<thead>
		<tr>
			<th>
				title
			</th>
			<th>
				Who
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($events as $event):?>
			<tr>
				<td>
					<?php echo $event['Event']['title'];?>
				</td>
				<td>
					<?php echo$this->Html->link('Who', array(
						'controller' => 'events',
					    'action' => 'who',
					     $event['Event']['_id']
					));?>
				</td>
			</tr>
		<?php endforeach;?>
		
	</tbody>
</table>
<?php else:?>
	<h1>You have not events</h1>
<?php endif;?>