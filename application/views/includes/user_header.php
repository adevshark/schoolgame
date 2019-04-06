<!DOCTYPE HTML>
<html lang="en">

<head>
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="<?php echo base_url('/assets/css/material-kit.css?v=2.0.5'); ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url('/assets/demo/demo.css'); ?>" rel="stylesheet" />
    
    <link href="<?php echo base_url('/assets/css/game.css?v=2.0.5'); ?>" rel="stylesheet" />
    <title><?php echo $title;?></title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container">
                <a class="navbar-brand" href="<?=site_url('/')?>">
                School Game <span style="font-size: 0.8rem;">(<?=$this->session->userdata['user_role']?>)</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php foreach ($menus as $each_key => $each_menu): ?>
                        <li class="nav-item <?php echo ($each_key == $current_menu)?'active':''; ?>">
                            <a class="nav-link" href="<?php echo site_url($each_menu['url']); ?>">
                                <i class="<?=$each_menu['icon']?>"></i>
                                <?=$each_menu['title']?><?php echo ($each_key == $current_menu)?'<span class="sr-only">(current)</span>':''; ?> 
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>