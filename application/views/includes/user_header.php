<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url('/assets/css/material-kit.css?v=2.0.5'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/game.css?v=2.0.5'); ?>" rel="stylesheet" />
    <title><?php echo $title;?></title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
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
                        <a class="nav-link" href="<?php echo site_url($each_menu['url']); ?>"><?=$each_menu['title']?><?php echo ($each_key == $current_menu)?'<span class="sr-only">(current)</span>':''; ?> </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                </div>
            </div>
        </nav>
    </div>