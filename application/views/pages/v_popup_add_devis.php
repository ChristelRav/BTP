<div id="shadow" class="overlay" onclick="closePopupUT()"></div>
    <div id="popup" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajout Devis</h4>
                        <form class="forms-sample" action="<?php echo site_url('CT_Devis/insert') ?>" method="post" >
                        <input type="hidden" name="id" class="form-control" id="id" >
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Date_création</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dc" class="form-control" id="nom" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Date_debut</label>
                                <div class="col-sm-9">
                                    <input type="date" name="db" class="form-control" id="nom" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">lieu</label>
                                <div class="col-sm-9">
                                    <input type="text" name="lieu" class="form-control" id="nom" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">type_finition</label>
                                <div class="col-sm-9">
                                <?php foreach ($finition as $f) { ?>
                                    <div class="form-check">
                                        <input type="radio" name="finition" id="<?php echo $f->id_finition; ?>" class="form-check-input" value="<?php echo $f->id_finition; ?>">
                                        <label for="<?php echo $f->id_finition; ?>" class="form-check-label"  ><?php echo $f->type_finition; ?></label>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info mr-2">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





