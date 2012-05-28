<div class="users index">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('twitter_screen_name', __('Name'));?></th>
			<th><?php echo $this->Paginator->sort('twitter_followers_count', __('Followers'));?></th>
			<th><?php echo $this->Paginator->sort('twitter_friends_count', __('Friends'));?></th>
            <th><?php echo $this->Paginator->sort('is_admin', __('Admin'));?></th>
			<th><?php echo $this->Paginator->sort('created', __('Membre depuis'));?></th>
			<th><?php echo $this->Paginator->sort('modified', __('Derniere visite'));?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td class="span1">
            <?php echo $this->Html->image($user['User']['twitter_profile_image_url']); ?>
        </td>
		<td>
            <?php echo h($user['User']['twitter_screen_name']); ?>
            (<?php echo h($user['User']['twitter_name']); ?>)
        </td>
		<td><?php echo h($user['User']['twitter_followers_count']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['twitter_friends_count']); ?>&nbsp;</td>		
        <td><?php echo h($user['User']['is_admin']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View User'), array('action' => 'view', $user['User']['twitter_screen_name'], 'admin' => false)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>

	<ul class="pager">
        <li>
            <?php
        		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            ?>
        </li>
        <li>
            <?php
        		echo $this->Paginator->numbers(array('separator' => ''));
            ?>
        </li>
        <li>
            <?php
        		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </li>
	</ul>
</div>