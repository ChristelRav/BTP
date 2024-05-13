
   
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
                          <?php   foreach ($resultats as $id_travaux => $details) { ?>
                            <tr>
                              <td><?php echo $details['num_travaux']; ?></td>
                              <td><strong><?php echo $details['travaux']; ?></strong></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <?php   foreach ($details['details'] as $detail) { ?>
                                      <td class="py-1"  ><?php echo  $detail['num_sous_travaux']; ?></td>
                                      <td><?php echo  $detail['sous_travaux']; ?></td>
                                      <td><?php echo $detail['unite']; ?></td>
                                      <td><?php echo $detail['quantite']; ?></td>
                                      <td><?php echo  number_format($detail['prix_unit'], 2, ',', ' '); ?></td>
                                      <td><?php echo  number_format($detail['totalP'], 2, ',', ' '); ?></td>
                                    </tr>
                            <?php } ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total <?php echo $details['travaux']; ?></strong></td>
                            <td><strong><?php echo number_format($details['total'], 2, ',', ' '); ?></strong></td>
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
        