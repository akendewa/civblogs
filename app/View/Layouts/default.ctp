<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo $title_for_layout; ?> - civblogs - L'annuaire des blogs de la cote d'ivoire
        </title>
        <?php            
            
            echo $this->Html->css(array(
                'bootstrap.min',
                'docs',
                'font-awesome',
                'style'
                )
            );
            
            echo $this->Html->script(
                array(
                    'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
                    'bootstrap.min',
                ),
                array('block' => 'scriptBottom')
            ); 
            
            echo $this->Html->meta('icon');                       


            echo $this->fetch('meta');
            echo $this->fetch('css');		        
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">    
        <style>
            
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <meta property="og:image" content="<?php echo Router::url('/img/civblogs.jpg')?>" />
        <link rel="apple-touch-icon-precomposed" href="<?php echo Router::url('/img/civblogs.jpg')?>">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <header>
                    <div class="row-fluid">
                    <div class="span10">
                    <h1>
                        <a class="brand" href="<?php echo Router::url('/') ?>">
                            <i class="icon-pencil"></i> <span class="logo-civ">civ</span><span class="logo-blogs">blogs</span>
                        </a>
                      <small>L'annuaire des blogs de la cote d'ivoire</small>
                    </h1>
                    </div>
                    <div class="span2">
                        <a href="<?php echo Router::url(array('controller' => 'blogs', 'action' => 'add', 'admin' => false)) ?>" class="btn btn-warning"><?php echo __('Suggest a blog') ?></a>
                    </div>
                    </div>
                    <div class="subnav">
                        <ul class="nav nav-pills">
                            <li class=""><a href="<?php echo Router::url('/') ?>">Accueil</a></li>
                            <?php
                                if (!empty($menuCategories)) {
                                    foreach ($menuCategories as $menuCategory) {
                                        echo '<li>';
                                        echo $this->Html->link($menuCategory['Category']['name'], array('controller' => 'posts', 'action' => 'search', 'category' => $menuCategory['Category']['slug'], 'admin' => false));
                                        echo '</li>';
                                    }
                                }
                            ?>
                            
                         <?php if(isset($user) && ($user!=null)) : ?>
                            <li>
                                <?php
                                    echo $this->Html->link($user['User']['twitter_screen_name'], array('controller' => 'users', 'action' => 'view', $user['User']['twitter_screen_name']));
                                ?>
                            </li>
                            <li>
                                <?php
                                    echo $this->Html->link(__d('users','Logout', true), array('controller' => 'users', 'action' => 'logout', 'admin' => false));
                                ?>
                            </li>
                            <?php if($user['User']['is_admin']) : ?>
                            <li class="divider-vertical"></li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Admin <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php
                                            echo $this->Html->link(__('Posts', true), array('controller' => 'posts', 'action' => 'index', 'admin' => true));
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link(__('Blogs', true), array('controller' => 'blogs', 'action' => 'index', 'admin' => true));
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link(__('Users', true), array('controller' => 'users', 'action' => 'index', 'admin' => true));
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link(__('Categories', true), array('controller' => 'categories', 'action' => 'index', 'admin' => true));
                                        ?>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                        </ul>
                    </div>
                </header>
            </div>
        </div>

        <div class="row">
            <div class="span12">
                <?php echo $this->Session->flash(); ?>
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h1><?php echo $title_for_layout ?></h1>                
                </div>
                <?php echo $this->fetch('content'); ?>
            </div>              
        </div>
        <div class="row">
            <div class="span12">
<hr />
                <p><strong>civblogs</strong> - Un projet <a href="https://github.com/akendewa/civblogs">Open Source</a> par <a href="http://www.akendewa.org">Akendewa</a>
                </p>
            </div>  
        </div>
        <div class="row">
            <div class="span12">
                <?php echo $this->element('sql_dump'); ?>
            </div>
        </div>
    </div> <!-- /container -->        
    <!-- Scripts -->
        <?php    
            echo $this->fetch('scriptBottom');
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.dropdown-toggle').dropdown()
            });
        </script>
    </body>
</html>

