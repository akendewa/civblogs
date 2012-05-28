<div class="blogs index">
	<table class="table table-striped table-bordered table-condensed">
    	<tr>
            <th class="span1"></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
            <th class="span3"><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('url', __('URL & Feed'));?></th>
			<th class="span2"><?php echo $this->Paginator->sort('posts_count');?></th>
			<th><?php echo $this->Paginator->sort('is_active');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>			
			<th class="actions"><?php echo __('Actions');?></th>
    	</tr>
	    <?php foreach ($blogs as $blog): ?>
        	<tr id="<?php echo $blog['Blog']['id'] ?>">
        		<td><?php echo $this->Html->image($blog['Blog']['preview_image_url']); ?>&nbsp;</td>
        		<td><?php echo h($blog['Blog']['name']); ?>&nbsp;</td>
                <td><?php echo h($blog['Blog']['description']); ?>&nbsp;</td>
        		<td>
                    <?php echo $this->Html->link('http://'.$blog['Blog']['url']); ?> <br />
                    <?php echo $this->Html->link('http://'.$blog['Blog']['feed']); ?>
                </td>
        		<td>
                    <?php echo h($blog['Blog']['posts_count']); ?> <br/>
                    <?php echo $this->Form->postLink(__('Fetch new posts'), array('action' => 'fetch_rss_feed', $blog['Blog']['id'], $this->Paginator->current('Blog'), 'admin' => true)); ?>            
                    <br />
                    <?php echo $this->Html->link(__('See all fetched posts'), array('controller' => 'posts', 'action' => 'index', 'blog' => $blog['Blog']['id'], 'admin' => true)); ?>            
                </td>
        		<td>
                    <?php 
                        if ($blog['Blog']['is_active']) {
                            echo __('Yes');
                        } else {
                            echo __('No');
                        }
                    ?>
                </td>
        		<td><?php echo h($blog['Blog']['created']); ?>&nbsp;</td>
        		<td><?php echo h($blog['Blog']['updated']); ?>&nbsp;</td>		
        		<td class="actions">
		        	<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blog['Blog']['id']) ); ?><br />           
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
	<div class="paging">
    	<?php
	    	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	    	echo $this->Paginator->numbers(array('separator' => ''));
	    	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	    ?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Blog'), array('action' => 'add')); ?></li>
	</ul>
</div>
