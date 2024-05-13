<?php if(!isset($dash)) $dash = array(); ?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Choix Année</h4>
            <p class="card-description">Annee</p>
            <form class="forms-sample"  action="<?php echo site_url('CT_Tableau/dash') ?>" method="post" >
              <div class="form-group">
                <label for="exampleInputUsername1">Annee</label>
                <input type="number" min="2020" max="<?php echo date("Y");?>" name="an" class="form-control" id="exampleInputUsername1" placeholder="2020">
              </div>
              <button type="submit" class="btn btn-info mr-2">Selectionner</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="row w-100 flex-grow">
          <div class="col-md-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Bar chart</h4>
                <canvas id="barChart" data-donnees="<?php echo htmlspecialchars(json_encode($dash)); ?>"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- row end -->
  </div>
</div>

 