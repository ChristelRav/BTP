
<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" >

<?php if (!isset($finition)) $finition = array(); ?>           
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste de Taux de finition</h4>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Type_finition</th>
                            <th>pourcentage(%)</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($finition as $f) { ?>
                              <tr>
                                <td class="py-1"><?php echo $f->type_finition; ?></td>
                                <td><?php echo $f->pourcentage; ?><td>
                                <td><a type="button" href="#"  href="javascript:void(0);" onclick="openPopupUPF(<?php echo htmlspecialchars(json_encode( $f)); ?>)"  class="btn btn-primary"><i class="mdi mdi-pencil mx-0"></i></a></td>
                              </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php $this->load->view('pages/v_popup_update_finition'); ?>
            <!-- row end -->
          </div>

                 
          <script>
    function openPopupUPF(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUF");

        overlay.style.display = "flex";
        popup.style.display = "block";

        // Utiliser les données du film pour remplir le formulaire
        document.getElementById('id').value = film.id_finition;
        document.getElementById('type').value = film.type_finition;
        document.getElementById('cent').value = film.pourcentage;
    }

    function closePopupF() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUF");

        overlay.style.display = "none";
        popup.style.display = "none";
    }
</script>

          