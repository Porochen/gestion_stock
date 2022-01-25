<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
          <h3>Editer un fournisseur</h3> 
        </div>
        <div class="card-body tdy-appoin">

         <form action="<?= base_url('index.php/ihm/Fournisseur/update/'.$fnr['id_fournisseur'])?>" method="post">
          <div class="row">
           
            <div class="col-md-4">
              <label>Nom</label> 
              <input name="nom_fournisseur"  value="<?=$fnr['nom_fournisseur']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('nom_fournisseur')?>
               </font>
            </div> 
            <div class="col-md-4">
              <label>Prenom</label> 
              <input name="prenom_fournisseur"  value="<?=$fnr['prenom_fournisseur']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('prenom_fournisseur')?>
               </font>
            </div>
            <div class="col-md-4">
              <label>Telephone</label> 
              <input name="tel_client"  value="<?=$fnr['tel_client']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('tel_client')?>
               </font>
            </div>
            <div class="col-md-4">
              <label>Is whatsapp</label> 
              <input name="is_whatsapp"  value="<?=$fnr['is_whatsapp']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('is_whatsapp')?>
               </font>
            </div>
            <div class="col-md-4">
              <label>E_mail</label> 
              <input name="email_fournisseur"  value="<?=$fnr['email_fournisseur']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('email_fournisseur')?>
               </font>
            </div>
            <div class="col-md-4">
              <label>Addresse</label> 
              <input name="adresse_fournisseur"  value="<?=$fnr['adresse_fournisseur']?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('adresse_fournisseur')?>
               </font>
            </div>
            <div class="col-md-4">
             <label>Province</label> 
              <select name="province_id" id="province_id" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($province as $value) { 
           if ($value['province_id']==$fnr['province_id']) {   ?>
              <option selected="" value="<?=$value['province_id']?>">
               <?= $value['province_name']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['province_id']?>">
               <?= $value['province_name']?>
              </option>
<?php  } } ?>
    
              </select>
              <?=form_error('province_id')?>
            </div>
            <div class="col-md-4">
             <label>Commune</label> 
              <select name="commune_id" id="commune_id" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($commune as $value) { 
           if ($value['commune_id']==$fnr['commune_id']) {   ?>
              <option selected="" value="<?=$value['commune_id']?>">
               <?= $value['commune_name']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['commune_id']?>">
               <?= $value['commune_name']?>
              </option>
<?php  } } ?>
    
              </select>
              <?=form_error('commune_id')?>
            </div>
            <div class="col-md-4">
             <label>Zone</label> 
              <select name="zone_id" id="zone_id" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($zone as $value) { 
           if ($value['zone_id']==$fnr['zone_id']) {   ?>
              <option selected="" value="<?=$value['zone_id']?>">
               <?= $value['zone_name']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['zone_id']?>">
               <?= $value['zone_name']?>
              </option>
<?php  } } ?>
    
              </select>
              <?=form_error('zone_id')?>
            </div>

            <div class="col-md-4">
             <label>Colline</label> 
              <select name="colline_id" id="colline_id" class="form-control">
               <option value="">Séléctionner</option>
<?php  foreach ($colline as $value) { 
           if ($value['colline_id']==$fnr['colline_id']) {   ?>
              <option selected="" value="<?=$value['colline_id']?>">
               <?= $value['colline_name']?>
              </option>
<?php     } else {  ?>
            <option value="<?=$value['colline_id']?>">
               <?= $value['colline_name']?>
              </option>
<?php  } } ?>
    
              </select>
              <?=form_error('colline_id')?>
            </div>


            <div class="col-md-4 mt-4">
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



<script>
 $(document).ready(function(){

 })
 $('#province_id').on('change',function(){
  var province_id=$(this).val()
  if (province_id!=0) {
   $.ajax({
    url:'<?= base_url()?>ihm/fournisseur/get_commune',
    type:'post',
    data:{province_id:province_id},
    success:function(data){
     $('#commune_id').html(data)
   }
 })
 }
})
</script>

<script>
 $(document).ready(function(){

 })
 $('#commune_id').on('change',function(){
  var commune_id=$(this).val()
  if (commune_id!=0) {
   $.ajax({
    url:'<?= base_url()?>ihm/fournisseur/get_zone',
    type:'post',
    data:{commune_id:commune_id},
    success:function(data){
     $('#zone_id').html(data)
   }
 })
 }
})
</script>

<script>
 $(document).ready(function(){

 })
 $('#zone_id').on('change',function(){
  var zone_id=$(this).val()
  if (zone_id!=0) {
   $.ajax({
    url:'<?= base_url()?>ihm/fournisseur/get_colline',
    type:'post',
    data:{zone_id:zone_id},
    success:function(data){
     $('#colline_id').html(data)
   }
 })
 }
})
</script>
