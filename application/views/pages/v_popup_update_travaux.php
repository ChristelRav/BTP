<div id="shadow" class="overlay" onclick="closePopup()"></div>
    <div id="popupUT" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mise à jour</h4>
                        <form class="forms-sample" action="<?php echo site_url('CT_Travaux/updateT') ?>" method="post" >
                        <input type="hidden" name="id" class="form-control" id="id" >
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Numero</label>
                                <div class="col-sm-9">
                                    <input type="text" name="num" class="form-control" id="num" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Travaux</label>
                                <div class="col-sm-9">
                                    <input type="text" name="travaux" class="form-control" id="travaux" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Unité</label>
                                <div class="col-sm-9">
                                    <input type="text" name="unite" class="form-control" id="unite" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">prix Unitaire</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" name="prix" class="form-control" id="prix" >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info mr-2">Mise à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





