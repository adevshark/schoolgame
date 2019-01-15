<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
  <div class="container">
    <div class="navbar-translate">
      <a class="navbar-brand" href="<?=base_url();?>">
        School Games </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link"  href="javascript:void(0)" >
            <i class="material-icons">home</i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
            <i class="fa fa-gamepad"></i> Play Game
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('/login'); ?>" onclick="scrollToDownload()">
            <i class="fa fa-sign-in"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>