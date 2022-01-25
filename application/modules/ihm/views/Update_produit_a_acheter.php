<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
          <h3>Editer une categorie</h3> 
        </div>
        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Produit_a_acheter/update')?>" method="post">
          <div class="row">
                      <input type="hidden" name="id_produit"  value="<?=$categ['id_produit']?>" class="form-control">
             <label>Categories</label> 
              <select name="id_unite_mesure" id="id_unite_mesure" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($pdts as $value) { 
           if ($value['id_unite_mesure']==$categ['id_unite_mesure']) {   ?>
              <option selected="" value="<?=$value['id_unite_mesure']?>">
               <?= $value['descr_unite_mesure']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['id_unite_mesure']?>">
               <?= $value['descr_unite_mesure']?>
              </option>
<?php  } } ?>
    
              </select>


            <input type="hidden" name="id_produit"  value="<?=$pdtach['id_produit']?>" class="form-control">
            <div class="col-md-4">
              <label>Description</label> 
              <input name="description"  value="<?=$pdtach['description']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('description')?>
               </font>
            </div> 
            <div class="col-md-6 mt-4">
              <input type="submit" class="btn btn-primary form-control " value="Modofier">
            </div>
          </div>
         </form> 
          
        </div> 
      </div>
    </div>
    </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>
