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
              <label>Produits</label> 
              <select name="id_produit" id="id_produit" class="form-control">
               <option value="">Séléctionner</option> 

              <?php  foreach ($produits as $value) { 
           if ($value['id_produit']==set_value('id_produit')) {   ?>
              <option selected="" value="<?=$value['id_produit']?>">
               <?= $value['nom_produit']?>
              </option>
            <?php } else {  ?>
                 <option value="<?=$value['id_produit']?>">
                   <?= $value['nom_produit']?>
                 </option>
            <?php  } } ?>
    
              </select>
              <font class="text-danger">
               <?=form_error('id_produit')?>
               </font>
            </div>
            <div class="col-md-6">
              <label>Mode de payement</label> 
              <select name="id_mode_payement" id="id_mode_payement" class="form-control">
                <option value="">Séléctionner</option> 
<?php  foreach ($modePayement as $value) { 
           if ($value['id_mode_payement']==set_value('id_mode_payement')) {   ?>
              <option selected="" value="<?=$value['id_mode_payement']?>">
               <?= $value['payement_desc']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['id_mode_payement']?>">
               <?= $value['payement_desc']?>
              </option>
<?php  } } ?>
              </select>
              <font class="text-danger">
               <?=form_error('id_mode_payement')?>
               </font>
            </div>  
          </div>

          <div class="row">
            <div class="col-md-6">
              <label>Quantité</label> 
              <input type="number" class="form-control" name="quantite_vendue" id="quantite_vendue">
              <font class="text-danger">
               <?=form_error('quantite_vendue')?>
               </font>
            </div>
            <div class="col-md-6">
              <label>Solde</label> 
              <input class="form-control" disabled="" value="5000">
            </div>  
          </div>

          <div class="row">
            <div class="col-md-12 mt-4">
              <input type="submit" class="btn btn-primary float-right" value="Enregistrer & Imprimer">
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
 