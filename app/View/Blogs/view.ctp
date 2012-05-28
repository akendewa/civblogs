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
            <h3>A propos de ce blog</h3>
            <p class="clearfix">
                <?php echo $this->Html->image($blog['Blog']['preview_image_url'], array('class' => 'thumbnail')); ?>
            </p>
            <p>
                <?php echo $blog['Blog']['description'] ?>
            </p>
            <p>
                <?php echo $this->Html->link('http://'.$blog['Blog']['url']) ?>
            </p>
            <p>
                <strong><?php echo $blog['Blog']['posts_count'] ?> billets</strong> index&eacute;s sur civblogs.
            </p>
        </div>
    </div>
</div>

