<table class="table table-striped table-bordered table-condensed">
	<tr>
			<th class="span2"><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('blog_id');?></th>
			<th class="span4"><?php echo $this->Paginator->sort('Preview');?></th>
			<th><?php echo $this->Paginator->sort('is_active');?></th>
			<th><?php echo $this->Paginator->sort('hits_count');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($posts as $post): ?>
	<tr id="<?php echo $post['Post']['id'] ?>">
		<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($post['Blog']['name'], array('controller' => 'posts', 'action' => 'index', 'admin' => 'true', 'blog' => $post['Blog']['id'])); ?>
		</td>
		<td>            
            <?php
                if ($post['Post']['image_url'] != '') {
                    echo $this->Html->image($post['Post']['image_url'], array('class' => 'span1', 'style' => 'float:left; margin : 5px;'));
                }
                if ($post['Post']['description']!= '') {
                    echo h($post['Post']['description']);
                } else {
                    echo $this->Form->postLink(__('Fetch Preview'), array('action' => 'fetch_preview', 'admin' => true, $post['Post']['id'], $this->Paginator->current('Post')), array('class' => 'btn'));
                }
?>
        </td>
		<td>
            <?php
                if ($post['Post']['is_active']) {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
            ?><br />
            <?php
                    echo $this->Form->postLink(__('Change'), array('action' => 'change_active_status', 'admin' => true, $post['Post']['id'], $this->Paginator->current('Post')), array('class' => 'btn'));
?>
        </td>
		<td><?php echo h($post['Post']['hits_count']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
