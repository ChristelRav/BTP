
<?php if(!isset($som)) $som = array(); ?>
<?php if(!isset($detail)) $detail = array(); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Entité DEVIS :</h4></div>
                <div class="card-body"> 
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>Num_Travaux</th>
                            <th>Travaux</th>
                            <th>unite</th>
                            <th>quantite</th>
                            <th>prix Unitaire</th>
                            <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php   foreach ($resultats as $detail) { ?>
                                      <td class="py-1"  ><?php echo  $detail->num_sous_travaux; ?></td>
                                      <td><?php echo  $detail->sous_travaux; ?></td>
                                      <td><?php echo $detail->unite; ?></td>
                                      <td><?php echo $detail->quantite; ?></td>
                                      <td><?php echo  number_format($detail->prix_unit, 2, ',', ' '); ?></td>
                                      <td><?php echo  number_format($detail->total, 2, ',', ' '); ?></td>
                                    </tr>
                            <?php } ?>
                            <tr>
                                      <th></th><th></th><th></th><th></th>
                                      <th><Strong>somme devis</Strong></th>
                                      <td><strong><?php echo $som->total; ?></strong></td>
                            </tr>
                            <tr>
                                      <th></th><th></th><th></th><th></th>
                                      <th><Strong>somme finition</Strong></th>
                                      <td><strong><?php echo $som->finit; ?></strong></td>
                            </tr>
                            <tr>
                                      <th></th><th></th><th></th><th></th>
                                      <th><Strong>Total somme devis</Strong></th>
                                      <td><strong><?php echo $som->som; ?></strong></td>
                            </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- row end -->
          <div class="row">
            
            
          </div>
          <!-- row end -->
        </div>
        