<div class="blogs form">
    <?php echo $this->Form->create('Blog');?>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('url',
            array(
                'div' => array('class' => 'input-prepend'),
                'between' => '<span class="add-on">http://</span>',
            )
        );
		echo $this->Form->input('feed',
            array(
                'div' => array('class' => 'input-prepend'),
                'between' => '<span class="add-on">http://</span>',
            )
        );
		echo $this->Form->input('preview_image_url');
		echo $this->Form->input('is_active');
		echo $this->Form->input('description');
	?>
    <?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Blogs'), array('action' => 'index'));?></li>
	</ul>
</div>
