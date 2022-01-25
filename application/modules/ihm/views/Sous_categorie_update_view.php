<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
          <h3>Editer une sous categorie</h3> 
        </div>
        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Sous_categorie/update')?>" method="post">
          <div class="row">
            <input type="hidden" name="id_sous_categorie"  value="<?=$categ['id_sous_categorie']?>" class="form-control">
             <label>Categories</label> 
              <select name="id_categorie" id="id_categorie" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($cat as $value) { 
           if ($value['id_categorie']==$categ['id_categorie']) {   ?>
              <option selected="" value="<?=$value['id_categorie']?>">
               <?= $value['descr_categorie']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['id_categorie']?>">
               <?= $value['descr_categorie']?>
              </option>
<?php  } } ?>
    
              </select>


            <div class="col-md-6">
              <label>Description</label> 
              <input name="descr_sous_categorie"  value="<?=$categ['descr_sous_categorie']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('descr_sous_categorie')?>
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
