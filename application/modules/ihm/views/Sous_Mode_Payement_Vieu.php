<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
          <h3>Editer une sous mode de payement</h3> 
        </div>
        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Mode_Paiement/add')?>" method="post">
          <div class="row">
            <input type="hidden" name="id_sous_mode_payement"  value="<?=$categ['id_mode_payement']?>" class="form-control">
             <label>mode payement</label> 
              <select name="id_mode_payement" id="id_mode_payement" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($cat as $value) { 
           if ($value['id_mode_payement']==$categ['id_mode_payement']) {   ?>
              <option selected="" value="<?=$value['id_mode_payement']?>">
               <?= $value['payement_desc']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['id_mode_payement']?>">
               <?= $value['payement_desc']?>
              </option>
<?php  } } ?>
    
              </select>


            <div class="col-md-6">
              <label>Description</label> 
              <input name="payement_desc"  value="<?=$categ['payement_desc']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('payement_desc')?>
               </font>
            </div> 
            <div class="col-md-6 mt-4">
              <input type="submit" class="btn btn-primary form-control " value="Modifier">
            </div>
          </div>
         </form> 
          
        </div> 
      </div>
    </div>
    </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>
