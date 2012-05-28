<div class="categories form">
    <?php echo $this->Form->create('Category');?>
	    <?php
	    	echo $this->Form->input('id');
	    	echo $this->Form->input('name');
	    ?>
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary'));?>
        <?php echo $this->Form->end();?>
    </div>
    <hr />
    <div class="actions">
	    <h3><?php echo __('Actions'); ?></h3>
    	<ul>
    		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index'));?></li>
    		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
    		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
    	</ul>
    </div>
</div>
