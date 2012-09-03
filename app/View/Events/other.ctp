<?php if(count($events)>0): ?>
<table>
	<thead>
		<tr>
			<th>
				title
			</th>
			<th>
				I go
			</th>
		</tr>
	</thead>
	<tbody>
		<?php// echo('<pre>');print_r($events);die;?>
		<?php foreach($events as $event):?>
			<tr>
				<td>
					<?php echo $event['Event']['title'];?>
				</td>
				<td><?php echo $this->Html->link('I go', array(
						'controller' => 'events',
					    'action' => 'igo',
					    $event['Event']['_id']
					)); ?>
				</td>
			</tr>
		<?php endforeach;?>
		
	</tbody>
</table>
<?php else:?>
	<h1>No events</h1>
<?php endif;?>