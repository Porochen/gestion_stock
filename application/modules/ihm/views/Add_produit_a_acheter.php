<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>
 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
          <h3><?=$title?></h3> 
        </div>
        <div class="card-body tdy-appoin">
         <form action="<?= base_url('index.php/ihm/Produit_a_acheter/add_new')?>" method="post" enctype="multipart/form-data">
          <div class="row">

          <div class="col-md-4">
            <label>Unite de mesure</label> 
            <select name="id_unite_mesure" id="id_unite_mesure" class="form-control">
             <option value="">Séléctionner</option>
          <?php  foreach ($unite as $value) { 
                     if ($value['id_unite_mesure']==set_value('id_unite_mesure')) {   ?>
                        <option selected="" value="<?=$value['id_unite_mesure']?>">
                         <?= $value['descr_unite_mesure']?>
                        </option>
          <?php     } else {  ?>
                      <option value="<?=$value['id_unite_mesure']?>">
                         <?= $value['descr_unite_mesure']?>
                        </option>
          <?php  } } ?>
              
              </select>
           </div>

            <div class="col-md-4">
              <label>Description</label> 
              <input name="description" value="<?=set_value('description')?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('')?>
               </font>
            </div> 
                        <div class="col-md-4">
              <label>Photo</label> 
              <input type="file" name="image" value="<?=set_value('image')?>" class="form-control" placeholder="la photo">
                 <font class="text-danger">
               <?=form_error('')?>
               </font>
            </div> 
            <div class="col-md-6 mt-4">
              <input type="submit" class="btn btn-primary form-control " value="Enregistrer">
            </div>
          </div>
         </form>  
        </div> 
      </div>
    </div>
    </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>
