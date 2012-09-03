<?php if(count($users)>0): ?>
<table>
	<thead>
		<tr>
			<th>
				username
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user):?>
			<tr>
				<td>
					<?php echo $user['User']['username'];?>
				</td>
			</tr>
		<?php endforeach;?>
		
	</tbody>
</table>
<?php else:?>
	<h1>No one user not going to this event</h1>
<?php endif;?>