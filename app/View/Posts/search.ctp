<div class="row">
    <div class="span8">
        <div class="posts">
            <?php foreach ($posts as $post) :?> 
                <?php echo $this->element('post.preview', array('post' => $post)); ?>
            <?php endforeach;?>            
        </div>                
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
    <div class="span4">
        <div class="well">
            <h3>Akwaba!</h3>
            <p><strong>civblogs</strong> est un annuaire qui indexe les billets provenant de la blogosphere ivoirienne.</p>
            <p><strong>civblogs</strong> vous permet de suivre vos blogs favoris et d'en d&eacute;couvrir de nouveaux.</p>
            <p>Vous pouvez aussi <a href="<?php echo Router::url(array('controller' => 'blogs', 'action' => 'add')) ?>">sugg&eacute;rer un blogue</a>.</p>
            <hr />
            <p><strong>civblogs</strong> est un projet <a href="https://github.com/akendewa/civblogs">open source</a> r&eacute;alis&eacute; par les <a href="http://dev.akendewa.org">d&eacute;veloppeurs b&eacute;n&eacute;voles</a> d'Akendewa.</p>
        </div>
    </div>
</div>
