<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
          <div class="card-header">
          <h3>Editer l'unite de mesure</h3> 
          <a href="<?= base_url("ihm/Mode_Unite_Mesure")?>" class="btn btn-outline-primary float-right"><i class="fa fa-list"></i> Liste</a>
        </div>
        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Mode_Unite_Mesure/update')?>" method="post">
          <div class="row">
            <input type="hidden" name="id_unite_mesure"  value="<?=$categ['id_unite_mesure']?>">
            <div class="col-md-6">
              <label>Description</label> 
              <input name="descr_unite_mesure"  value="<?=$categ['descr_unite_mesure']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('descr_unite_mesure')?>
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
