<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
          <div class="card-header">
          <h3>Editer une le model de payement</h3> 
          <a href="<?= base_url("ihm/Mode_Paiment")?>" class="btn btn-outline-primary float-right"><i class="fa fa-list"></i> Liste</a>
        </div>
        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Mode_Paiment/update')?>" method="post">
          <div class="row">
            <input type="hidden" name="id_mode_payement"  value="<?=$categ['id_mode_payement']?>">
            <div class="col-md-6">
              <label>Description</label> 
              <input type="text" name="payement_desc" id="payement_desc"  value="<?=$categ['payement_desc']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?= form_error('payement_desc')?>
               </font> 
            </div>
            <div class="col-md-6 mt-4">
              <input type="submit" class="btn btn-primary float-right" value="Modifier">
            </div>
            </div> 
            
          </div>
         </form> 
          
        </div> 
      </div>
    </div>
    </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>
