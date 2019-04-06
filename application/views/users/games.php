<div class="container">
    <?php
    if( count($keys)==0) {
        echo "<div class='alert alert-danger'>You must input license key to play game!</div>";
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card" >
                <img class="card-img-top" src="<?=base_url('/assets/img/games/game1.jpg');?>" alt="Card image cap">
                <div class="card-body">
                    <h3>Angle Connections</h3>
                    <p class="card-text">An Educational Game Developed to Help Students Learn Transversal Lines.</p>
                    <a href="<?=site_url('/games/ac')?>" target="_blank" class="btn btn-primary btn-lg"><i class='fa fa-play'></i> Play</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img class="card-img-top" src="<?=base_url('/assets/img/games/game2.jpg');?>" alt="Card image cap">
                <div class="card-body">
                    <h3>Unit Circle Rummy</h3>
                    <p class="card-text">An Educational Game Developed to Help Students Learn the Unit Circle.</p>
                    <a href="<?=site_url('/games/ucr')?>" target="_blank" class="btn btn-primary btn-lg"><i class='fa fa-play'></i> Play</a>
                </div>
            </div>
        </div>
    </div>
</div>