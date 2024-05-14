
   
<?php if(!isset($listDevis)) $listDevis = array(); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                      <h4 class="card-title mb-0">Entité DEVIS :</h4>
                      <a type="button" href="<?php echo site_url('CT_Tableau/attente'); ?>"   class="btn btn-info">Devis en attente</a>
                </div>
                <div class="card-body"> 
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>Date_devis</th>
                            <th>type_maison</th>
                            <th>type_finition</th>
                            <th>(%)</th>
                            <th>debut_travaux</th>
                            <th>fin_travaux</th>
                            <th>Paye effectués</th>
                            <th><strong>paiement(%)</strong></th>
                            <th>Reste à payer</th>
                            <th><strong>Total à payer</strong></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($listDevis as $ld) { ?>
                        <tr>
                            <td class="py-1"  ><a href="<?php echo site_url('CT_Devis/detail'); ?>?devis=<?php echo $ld->id_devis_client; ?> "><?php echo $ld->ref_devis; ?></a></td>
                                  <td><?php echo $ld->type_maison; ?></td>
                                  <td><?php echo $ld->type_finition; ?></td>
                                  <td><?php echo $ld->pourcentage; ?></td>
                                  <td><?php echo $ld->date_debut; ?></td>
                                  <td><?php echo $ld->date_fin; ?></td>
                                  <td><?php echo number_format($ld->deja_payer, 2, ',', ' '); ?></td>
                                  <td><?php echo number_format($ld->paiement, 2, ',', ' '); ?></td>
                                  <td><?php echo number_format($ld->reste_a_payer, 2, ',', ' '); ?></td>
                                  <td><?php echo number_format($ld->ttl, 2, ',', ' '); ?></td>
                            </tr>
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
        