<div class="post clearfix">
    <a href="#" class="pull-left">
        <?php
            $image = '';
                if ($post['Post']['image_url'] != '') {
                    $image = $post['Post']['image_url'];
                } else {
                    $image = $post['Blog']['preview_image_url'];
                }
                echo $this->Html->image($image,
                    array(
                        'class' => 'thumbnail',
                        'style' => 'margin-right : 10px; width : 100px; height : 100px; float : left;'
                    )
                );
            ?>
    </a>
    <h4>
        <?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'go', $post['Post']['id']), array('target' => '_blank')); ?>
    </h4>
    <div style="margin-bottom: 5px">
        <strong>
            <?php echo $this->Html->link($post['Blog']['name'],
                array(
                    'controller' => 'blogs',
                    'action' => 'view',
                    $post['Blog']['url']
                ));
            ?>
        </strong> - 
        <?php
            $tagsHtml = Array();
            foreach($post['Tag'] as $tag) {
                $tagsHtml[] = '<small class="small">'.$this->Html->link($tag['name'], array('controller' => 'posts', 'action' => 'search', 'tag' => $tag['keyname'])).'</small>';
            }
            echo $this->Text->toList($tagsHtml, 'et ');
        ?>
    </div>                                       
    <?php
        echo $post['Post']['description'];
    ?>... - <small><i><?php echo $this->Time->nice($post['Post']['created']) ?></i></small>
    <hr/ >                           
</div>
