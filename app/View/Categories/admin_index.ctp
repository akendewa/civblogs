<div class="categories index">
	<table class="table table-striped table-bordered table-condensed">
    	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
    	</tr>
	    <?php foreach ($categories as $category): ?>
    	<tr>
	    	<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
    		<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
    		<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
    		<td><?php echo h($category['Category']['updated']); ?>&nbsp;</td>
    		<td class="actions">
    			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
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
    <ul class="pagination">
        <li>
            <?php
        		echo $this->Paginator->prev('< ' . __('Page précédente'), array('escape' => true), null, array('class' => 'prev disabled', 'escape' => 'true'));
            ?>
        </li>
        <li>
            <?php
        		echo $this->Paginator->numbers(array('separator' => ''));
            ?>
        </li>
        <li>
            <?php
        		echo $this->Paginator->next(__('Page suivante') . ' >',  array('escape' => false), null, array('class' => 'next disabled'));
            ?>
        </li>
	</ul>
</div>
<hr />
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
