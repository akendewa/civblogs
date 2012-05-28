<div class="blogs form">
    <p class="well">
        Veuillez remplir ce formulaire SVP. Votre blog s'affichera dans l'annuaire de <strong>civblogs</strong> d&egrave;s qu'un mod&eacute;rateur l'approve. Merci :-)
    </p>
    <?php echo $this->Form->create('Blog');?>
	<?php
		echo $this->Form->input('name', array('label' => __('Blog Name')));
		echo $this->Form->input('url',
            array(
                'label' => __('Blog url'),
                'div' => array('class' => 'input-prepend'),
                'between' => '<span class="add-on">http://</span>',
            )
        );		
	?>
    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary'));?>
    <?php echo $this->Form->end(); ?>
</div>
