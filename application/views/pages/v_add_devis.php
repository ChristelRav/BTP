<?php if (!isset($maison)) $maison = array(); ?>        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
                <?php foreach ($maison as $m) { ?>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                        <div class="card-body">
                                    <p class="card-title">Maison de Type : <?php echo $m->type_maison; ?></p>
                                    <p class="text-muted"><?php echo $m->type_maison; ?></p>
                                    <h2><?php echo $m->total; ?> Ar</h2>
                                    <p>Durée : <?php echo $m->duree; ?></p>
                                    <p><?php echo $m->caracteristique; ?></p>
                                    <button type="button" class="btn btn-info">Sélectionner</button>
                        </div>
                        </div>
                    </div>
                <?php } ?>


            </div>
            
            <!-- row end -->
            
            <!-- row end -->
          </div>
        