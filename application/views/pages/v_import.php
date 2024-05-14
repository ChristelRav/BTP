
    
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

            <div class="col-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Formulaire Import</h4>
                  <p class="card-description">
                    Maison - Travaux - Devis
                  </p>
                  <form class="forms-sample"  action="<?php echo site_url('CT_Import/import2'); ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                      <label>Doc Maison</label>
                      <input type="file" name="csv_file1" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Maison et travaux">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Doc Devis</label>
                      <input type="file" name="csv_file2" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="devis">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">import</button>
                  </form>
                </div>
              </div>
            </div>        

                        
                        <div class="col-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Formulaire Import</h4>
                            <p class="card-description">
                                Paiement
                            </p>
                            <form class="forms-sample"  action="<?php echo site_url('CT_Import/import1'); ?>" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                <label>Doc paiement</label>
                                <input type="file" name="csv_file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="paiement">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mr-2">import</button>
                            </form>
                            </div>
                        </div>
                        </div>

            </div>
            <!-- row end -->
           
            <!-- row end -->
          </div>
          