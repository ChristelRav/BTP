
<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" >
<script src="<?php echo base_url("assets/js/popup.js"); ?> "></script>


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
                                    <button type="button" href="javascript:void(0);" onclick="openPopup(<?php echo htmlspecialchars(json_encode($m->id_maison)); ?>)" class="btn btn-info">Sélectionner</button>
                        </div>
                        </div>
                    </div>
                <?php } ?>

                
            <?php $this->load->view('pages/v_popup_add_devis'); ?>


            </div>

            
            <!-- row end -->
            
            <!-- row end -->
          </div>
        

          
          <script>
    function openPopup(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popup");

        overlay.style.display = "flex";
        popup.style.display = "block";
    }

    function closePopup() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popup");

        overlay.style.display = "none";
        popup.style.display = "none";
    }
</script>
