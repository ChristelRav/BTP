<?php if (!isset($travaux)) $travaux = array(); ?>   
<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" >

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste des Travaux</h4>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Num_travaux</th>
                            <th>Travaux</th>
                            <th>Unite</th>
                            <th>prix Unitaire</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($travaux as $t) { ?>
                                  <tr>
                                    <td class="py-1"><?php echo $t->num_sous_travaux; ?></td>
                                    <td><?php echo $t->sous_travaux; ?></td>
                                    <td><?php echo $t->unite; ?></td>
                                    <td><?php echo $t->prix_unit; ?></td>
                                    <td><a type="button" href="#"  href="javascript:void(0);" onclick="openPopupUPT(<?php echo htmlspecialchars(json_encode( $t)); ?>)"  class="btn btn-primary"><i class="mdi mdi-pencil mx-0"></i></a></td>
                                  </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
                
            <?php $this->load->view('pages/v_popup_update_travaux'); ?>
            <!-- row end -->
          </div>


                   
<script>
    function openPopupUPT(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUT");

        overlay.style.display = "flex";
        popup.style.display = "block";

        // Utiliser les données du film pour remplir le formulaire
        document.getElementById('id').value = film.id_sous_travaux;
        document.getElementById('num').value = film.num_sous_travaux;
        document.getElementById('travaux').value = film.sous_travaux;
        document.getElementById('unite').value = film.unite;
        document.getElementById('prix').value = film.prix_unit;
    }

    function closePopupUT() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUT");

        overlay.style.display = "none";
        popup.style.display = "none";
    }
</script>
