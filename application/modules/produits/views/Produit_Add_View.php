<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

<style type="text/css">
  .form-control{
    /*background-color: #fff;*/
  }
</style>
 <div class="content-page">
    <div class="container-fluid">
      <div class="row">


      <div class="card card-block card-primary card-stretch card-height">
        <div class="card-header">
          <h3>Formulaire</h3> 
        </div>
        <div class="card-body tdy-appoin">
         <form action="<?= base_url('produits/Produits/add_new')?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <label>Categories</label> 
              <select name="id_categorie" id="id_categorie" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($categories as $value) { 
           if ($value['id_categorie']==set_value('id_categorie')) {   ?>
              <option selected="" value="<?=$value['id_categorie']?>">
               <?= $value['descr_categorie']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['id_categorie']?>">
               <?= $value['descr_categorie']?>
              </option>
<?php  } } ?>
    
              </select>
              <font class="text-danger">
               <?=form_error('id_categorie')?>
               </font>
            </div>
            <div class="col-md-6">
              <label>Sous categories</label> 
              <select name="id_sous_categorie" id="id_sous_categorie" class="form-control">
                <option value="">Séléctionner</option> 
              </select>
              <font class="text-danger">
               <?=form_error('id_sous_categorie')?>
               </font>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <label>Produit</label> 
              <input type="text" class="form-control" name="nom_produit" id="nom_produit" placeholder="nom du Produit">
              <font class="text-danger">
               <?=form_error('nom_produit')?>
               </font>
            </div>
            <div class="col-md-6">
              <label>Quantité</label> 
              <input name="quantite" id="quantite" class="form-control" placeholder="quantité">
              <font class="text-danger">
               <?=form_error('quantite')?>
               </font>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <label>Prix d'achat</label> 
              <input type="text" class="form-control" name="prix_unitaire_achat" id="prix_unitaire_achat" placeholder="prix unitaire d'achat">
              <font class="text-danger">
               <?=form_error('prix_unitaire_achat')?>
               </font>
            </div>
            <div class="col-md-6">
              <label>Prix de vante</label> 
              <input name="prix_unitaire_vente" id="prix_unitaire_vente" class="form-control" placeholder="prix unitaire de vente">
              <font class="text-danger">
               <?=form_error('prix_unitaire_vente')?>
               </font>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <label>Image</label>
              <input type="file" name="image" class="btn btn-primary form-control">
            </div>
            <div class="col-md-6">
              <label>Fournisseur</label>
<select name="id_fournisseur" id="id_fournisseur" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($fournisseur as $value) { 
           if ($value['id_fournisseur']==set_value('id_fournisseur')) {   ?>
              <option selected="" value="<?=$value['id_fournisseur']?>">
               <?= $value['nom']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['id_fournisseur']?>">
               <?= $value['nom']?>
              </option>
<?php  } } ?>
    
              </select>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-12 mt-4">
              <input type="submit" class="btn btn-primary float-right" value="Enregistrer">
            </div>
          </div>
         </form>  
        </div> 
      </div>


      </div>
    </div>
</div>





<?php include VIEWPATH.'includes/footer.php' ;?>




<script>
   $(document).ready(function(){

   })
   $('#id_categorie').on('change',function(){
      var id_categorie=$(this).val()

      if (id_categorie!=0) {
         $.ajax({
            url:'<?= base_url()?>produits/Produits/get_sous_categories',
            type:'post',
            data:{id_categorie:id_categorie},
            success:function(data){
             $('#id_sous_categorie').html(data)
            }
         })
      }
   })
</script>
 