<div id="shadow" class="overlay" onclick="closePopup()"></div>
    <div id="popup" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajout Devis</h4>
                        <form class="forms-sample" action="<?php echo base_url('CT_Devis/insert') ?>" method="post" >
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
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">type_finition</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm"  name="finition" id="type">
                                    <?php foreach ($finition as $f) { ?>
                                        <option value="<?php echo $f->id_finition; ?>"><?php echo $f->type_finition; ?></option>
                                    <?php } ?>
                                    </select>
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





