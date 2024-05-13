
   
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
                        </tr>
                      </thead>
                      <tbody>
                          <?php   foreach ($resultats as $travaux => $details) { ?>
                            <tr>
                              <td><?php echo $details['num_travaux']; ?></td>
                              <td><strong><?php echo $details['travaux']; ?></strong></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <?php   foreach ($details['id_sous_travaux'] as $key => $detail) { ?>
                                      <td class="py-1"  ><?php echo  $details['num_sous_travaux'][$key]; ?></td>
                                      <td><?php echo  $details['sous_travaux'][$key]; ?></td>
                                      <td><?php echo $details['unite'][$key]; ?></td>
                                      <td><?php echo $details['quantite'][$key]; ?></td>
                                      <td><?php echo  $details['prix_unit'][$key]; ?></td>
                                    </tr>
                            <?php } ?>
                          <?php } ?>
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
        