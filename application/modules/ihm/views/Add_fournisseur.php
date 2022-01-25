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
         <form action="<?= base_url('ihm/Fournisseur/add_new')?>" method="post">
          <div class="row">
            <div class="col-md-6">
              <label>Province</label> 
              <select name="province_id" id="province_id" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($prov as $value) { 
           if ($value['province_id']==set_value('province_id')) {   ?>
              <option selected="" value="<?=$value['province_id']?>">
               <?= $value['province_name']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['province_id']?>">
               <?= $value['province_name']?>
              </option>
<?php  } } ?>
    
              </select>
              
            <div class="col-md-6">
              <label>Nom</label> 
              <input type="text" name=" nom_fournisseur" value="<?=set_value('nom_fournisseur')?>" class="form-control" placeholder="Nom du fournisseur">
                 <font class="text-danger">
               <?=form_error('nom_fournisseur')?>
               </font>
            </div>

             <div class="col-md-6">
              <label>Prenom</label> 
              <input type="text" name="prenom_fournisseur" value="<?=set_value('prenom_fournisseur')?>" class="form-control" placeholder="Prenom du fournisseur">
                 <font class="text-danger">
               <?=form_error('prenom_fournisseur')?>
               </font>
            </div> 
           <div class="col-md-6">
              <label>Telephone</label> 
              <input type="text" name="tel_client" value="<?=set_value('tel_client')?>" class="form-control" placeholder="Telephone du client">
                 <font class="text-danger">
               <?=form_error('tel_client')?>
               </font>
            </div> 
             <div class="col-md-6">
              <label>WhatsApp</label> 
              <input type="radio" name=" is_whatsapp"  value="<?=set_value('is_whatsapp')?>" class="form-control">
                 <font class="text-danger">
               <?=form_error('is_whatsapp')?>
               </font>
            </div> 
              <div class="col-md-6">
              <label>E_mail</label> 
              <input type="E_mail" name="email_fournisseur" value="<?=set_value('email_fournisseur')?>" class="form-control" placeholder="E_mail du fournisseur">
                 <font class="text-danger">
               <?=form_error('email_fournisseur')?>
               </font>
            </div> 
                        <div class="col-md-6">
              <label>Addresse</label> 
              <input type="text" name=" adresse_fournisseur
" value="<?=set_value('adresse_fournisseur
')?>" class="form-control" placeholder="Addresse du fournisseur">
                 <font class="text-danger">
               <?=form_error('adresse_fournisseur
')?>
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
