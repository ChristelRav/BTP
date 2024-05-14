<?php if(!isset($paiement)) $paiement = array(); ?>
<?php if (!isset($devis)) $devis = array(); ?>     
<?php if (!isset($ttl)) $ttl = array(); ?>  
<?php if (!isset($reste)) $reste = array(); ?>  
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Formulaire de paiement</h4>
                  <p class="card-description">
                    Paiement_devis
                  </p>

                  <form class="forms-sample" id="paymentForm"  action="<?php echo site_url('CT_Payer/payer') ?>" method="post" >
                    <input type="hidden" name="devis" value="<?php echo $devis;?>">
                    <input type="hidden" name="ttl" value="<?php echo $ttl;?>">
                    <input type="hidden" name="reste" value="<?php echo $reste;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Montant</label>
                      <input type="number" min="0"  id="amount" name="amount" class="form-control" id="exampleInputUsername1" placeholder="montant">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" name="dp" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Payer</button>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Liste de Paiememnt</h4>
                          <p>Total à payer :   <?php echo $ttl; ?> Ar</p>
                          <p>Reste à payer :   <?php echo $reste; ?> Ar</p>
                          <p class="card-description">
                              Total<code>.Paiement</code>
                          </p>
                          <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Montant(Ar)</th>
                                          <th>Date de paiement </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php foreach ($paiement as $p) { ?>
                                      <tr>
                                          <td><?php echo  number_format($p->montant, 2, ',', ' '); ?></td>
                                          <td><?php echo $p->date_paiement; ?></td>
                                      </tr>
                                  <?php } ?>
                                  </tbody>
                              </table>
                      </div>
                  </div>
            </div>



            </div>
            <!-- row end -->
            <!-- row end -->
          </div><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#paymentForm').on('submit', function(e){
        e.preventDefault(); // Empêche le comportement par défaut du formulaire

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                if(response.error){
                    alert(response.error); // Affiche l'erreur
                } else{
                    // alert(response.error); 
                    window.location.href = "<?php echo site_url('CT_Accueil');?>";
                }
            },
            error: function(xhr, status, error){
                console.error("Erreur AJAX: " + error);
            }
        });
    });
});
</script>
