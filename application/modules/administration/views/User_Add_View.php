<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
           
               <div class="col-lg-12">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title"><?= $title?></h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                           <a href="<?= base_url('administration/Utilisateurs/')?>" class="btn btn-outline-primary"><i class="fa fa-list"></i> Liste</a>
                        </div>
                     </div>
                     <div class="card-body rec-pat">
                        <form action="<?=  base_url('administration/Utilisateurs/save') ?>" method="post" autocomplete="off">
                        <div class="row">
                          <div class="col-md-6">
                            <label>Nom d'utilisateur</label> 
                           <input type="text" value="<?=set_value('username')?>" class="form-control" name="username" id="username" placeholder="Nom d'utilisateur">
                            <font class="text-danger">
                             <?=form_error('username')?>
                             </font>
                          </div>
                          <div class="col-md-6">
                            <label>Téléphone</label> 
                            <input type="text" value="<?=set_value('phone')?>" class="form-control" name="phone" id="phone" placeholder="Téléphone">
                            <font class="text-danger">
                             <?=form_error('phone')?>
                             </font>
                          </div>  
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <label>Province</label> 
                            <select name="province_id" id="province_id" class="form-control">
                               <option value="">Sélectionner</option>
                    <?php  foreach ($province as $value) { 
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
                             <?=form_error('province_id')?>
                             </font>
                          </div>
                          <div class="col-md-6">
                            <label>Commune</label> 
                            <select class="form-control" name="commune_id" id="commune_id">
                              <option value="">Séléctionner d'abord la province</option>
                              <?php  foreach ($commune as $value) { 
                           if ($value['commune_id']==set_value('commune_id')) {   ?>
                              <option selected="" value="<?=$value['commune_id']?>">
                               <?= $value['commune_name']?>
                              </option>
                            <?php     }  }  ?>
                            </select>
                            <font class="text-danger">
                             <?=form_error('commune_id')?>
                             </font>
                          </div>  
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <label>Zone</label> 
                            <select class="form-control" name="zone_id" id="zone_id">
                              <option value="">Séléctionner d'abord la commune</option>
                              <?php  foreach ($zone as $value) { 
                           if ($value['zone_id']==set_value('zone_id')) {   ?>
                              <option selected="" value="<?=$value['zone_id']?>">
                               <?= $value['zone_name']?>
                              </option>
                            <?php     }  }  ?>
                            </select>
                            <font class="text-danger">
                             <?=form_error('zone_id')?>
                             </font>
                          </div>
                          <div class="col-md-6">
                            <label>Colline</label> 
                            <select class="form-control" name="colline_id" id="colline_id">
                              <option value="">Séléctionner d'abord la colline</option>
                              <?php  foreach ($colline as $value) { 
                           if ($value['colline_id']==set_value('colline_id')) {   ?>
                              <option selected="" value="<?=$value['colline_id']?>">
                               <?= $value['colline_name']?>
                              </option>
                            <?php     }  }  ?>
                            </select>
                            <font class="text-danger">
                             <?=form_error('colline_id')?>
                             </font>
                          </div> 

                          <div class="col-md-6">
                            <label>Adresse</label> 
                            <input type="text" value="<?=set_value('adresse')?>" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
                            <font class="text-danger">
                             <?=form_error('adresse')?>
                             </font>
                          </div><br>

                          <div class="col-md-6 mt-4">
                            <input type="submit" class="btn btn-outline-primary form-control" value="Enregistrer">
                          </div>  
                        </div>

                       </form> 
                     </div>
                  </div>
               </div>



      </div>
        <!-- Page end  -->
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
            url:'<?= base_url()?>administration/Utilisateurs/get_commune',
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
            url:'<?= base_url()?>administration/Utilisateurs/get_zone',
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
            url:'<?= base_url()?>administration/Utilisateurs/get_colline',
            type:'post',
            data:{zone_id:zone_id},
            success:function(data){
             $('#colline_id').html(data)
            }
         })
      }
   })
</script>
