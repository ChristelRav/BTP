
    
        
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

                  <?php if(isset($err)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  Les montants négatifs se trouvent aux lignes : </strong> <?php echo implode(', ', $err); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($err1)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  Surface invalides se trouvent aux lignes :</strong><?php echo implode(', ', $err1); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($err2)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  quantité invalides se trouvent aux lignes : </strong> <?php echo implode(', ', $err2); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>
                            

                            <?php if(isset($err3)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  Durée invalides se trouvent aux lignes :</strong><?php echo implode(', ', $err3); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($e)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!!!!!! Les Taux finition négatifs se trouvent aux lignes : </strong> <?php echo implode(', ', $e); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($e1)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!!!!!!!  Date devis invalides se trouvent aux lignes :</strong><?php echo implode(', ', $e1); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($e2)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!!!!!!!  Date fin invalides se trouvent aux lignes : </strong> <?php echo implode(', ', $e2); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

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

                            <?php if(isset($erreur)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  Les montants négatifs se trouvent aux lignes : </strong> <?php echo $erreur; ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($int)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  Les montants négatifs se trouvent aux lignes : </strong> <?php echo implode(', ', $int); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>

                            <?php if(isset($date)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                  <strong>Erreur!  Les dates invalides se trouvent aux lignes :</strong><?php echo implode(', ', $date); ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            <?php } ?>
                            
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
          