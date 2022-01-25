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
          <a href="<?= base_url('produits/Produits')?>" class="btn btn-primary float-right">
            <i class="fa fa-list"></i> Listing
          </a>
          <h3>Formulaire de vente</h3>
        </div>
        <div class="card-body tdy-appoin">

          <div class="row ml-2 mr-2" id="listing_vente">

          </div>

          <div class="row if_no_data" id="if_no_data">
            <div class="col-md-6">
              <label>Mode de payement</label> 
              <select name="id_mode_payement" id="id_mode_payement" class="form-control" onchange="client_info(this.value)">
                <option value="">Séléctionner</option> 
<?php  foreach ($modePayement as $value) { 
           if ($value['id_mode_payement']==set_value('id_mode_payement')|| $value['id_mode_payement']==1) {   ?>
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
            <div class="col-md-6" id="hidden_montant" style="display:none;">
              <label>Montant payé</label>
              <input type="number" class="form-control" name="montant_paye" id="montant_paye">
            </div>
            <div class="col-md-6 mt-4" id="hidden_btn">
              <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="imprimer()">Enregistrer & Imprimer</a>
            </div>  
          </div>

          <hr id="hidden_line" style="display:none;">

         <div class="client_info" id="client_info" style="display:none;">
          <div class="row">
            <div class="col-md-6">
              <label>Nom</label>
              <input type="text" id="nom_client" name="nom_client" class="form-control" placeholder="Nom du client"> 
            </div>
            <div class="col-md-6">
              <label>Prenom</label>
              <input type="text" id="prenom_client" name="prenom_client" class="form-control" placeholder="Nom du client"> 
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <label>Téléphone</label>
                  <input type="text" id="tel_client" name="tel_client" class="form-control" placeholder="Tél du client"> 
                </div>
                <div class="col-md-6">
                  <label>C'est pour whatsapp?</label>
                  <div class="mt-2 ml-2">
                    <label class="mr-2">Oui</label>
                    <input type="radio" value="1" id="is_whatsapp" name="is_whatsapp">
                    <label class="ml-3 mr-2">Non</label>
                    <input type="radio" value="0" id="is_whatsapp" name="is_whatsapp">
                  </div> 
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label>Email</label>
              <input type="text" id="email_client" name="email_client" class="form-control" placeholder="Email du client"> 
            </div> 
          </div> 
          <div class="row">
            <div class="col-md-6">
              <label>Province</label>
              <select id="province_id" name="province_id" class="form-control">
                <option value="">Séléctionner</option>
<?php   foreach ($provinces as $value) {
             if ($value['province_id']==set_value('province_id')) { ?>
               <option selected value="<?=$value['province_id']?>">
                 <?=$value['province_name']?>
               </option>
<?php        } else { ?>
               <option value="<?=$value['province_id']?>">
                 <?=$value['province_name']?>
               </option>
<?php        }
          } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label>Commune</label>
              <select id="commune_id" name="commune_id" class="form-control">
                <option>Séléctionner</option>
              </select> 
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Zone</label>
              <select id="zone_id" name="zone_id" class="form-control">
                <option>Séléctionner</option>
              </select> 
            </div>
            <div class="col-md-6">
              <label>Colline</label>
              <select id="colline_id" name="colline_id" class="form-control">
                <option>Séléctionner</option>
              </select> 
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Adresse</label>
              <input type="text" id="adresse_client" name="adresse_client" class="form-control" placeholder="Adresse du client">
            </div>
            <div class="col-md-6 mt-4">
              <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="imprimer()">Enregistrer & Imprimer</a>
            </div>
          </div>
         </div>
        </div> 
      </div>


      </div>
    </div>
</div>





<?php include VIEWPATH.'includes/footer.php' ;?>




<script>
   $(document).ready(function(){
     list_on_load();
     listing_vente();
   })


   function listing_vente(){
     $.ajax({
          type:'post',
          url:'<?=base_url()?>produits/Produits/listing_vente',
          data:{},
          success:function(data){
            $('#listing_vente').html(data);
          }
       });
   }
</script>

<script>



function remove_to_cart(id_produit=0){
  if (id_produit!=0) {
       $.ajax({
          type:'post',
          url:'<?=base_url()?>produits/Produits/remove_to_vente',
          data:{id_produit:id_produit},
          success:function(data){
           $('#listing_vente').html(data);
           list_on_load();
          }
       });
  }
}

function actualiser(id_produit=0){
  var value_actualiser=$('#value_actualiser'+id_produit).val();
  var prix_unitaire=$('#prix_unitaire'+id_produit).val();
  var montant_paye=value_actualiser*prix_unitaire;

  if (id_produit!=0) {
       $.ajax({
          type:'post',
          url:'<?=base_url()?>produits/Produits/update_vente',
          data:{id_produit:id_produit,montant_paye:montant_paye,quantite_vendue:value_actualiser},
          success:function(data){
           $('#listing_vente').html(data);
           // list_on_load();
          }
       });
  }
}


function imprimer(){
  var id_mode_payement=$('#id_mode_payement').val();
  var data;

  var nom_client=$('#nom_client').val();
  var prenom_client=$('#prenom_client').val();
  var tel_client=$('#tel_client').val();
  var is_whatsapp=$('#is_whatsapp').val();
  var email_client=$('#email_client').val();
  var province_id=$('#province_id').val();
  var commune_id=$('#commune_id').val();
  var zone_id=$('#zone_id').val();
  var colline_id=$('#colline_id').val();
  var adresse_client=$('#adresse_client').val();
  var montant_paye=$('#montant_paye').val();

  if (id_mode_payement==1) {
      data={id_mode_payement:id_mode_payement};
    }else{
      data={id_mode_payement:id_mode_payement,nom_client:nom_client,prenom_client:prenom_client,tel_client:tel_client,is_whatsapp:is_whatsapp,email_client:email_client,province_id:province_id,commune_id:commune_id,zone_id:zone_id,colline_id:colline_id,adresse_client:adresse_client,montant_paye:montant_paye};
    }
  $.ajax({
          type:'post',
          url:'<?=base_url()?>produits/Produits/vente_produit',
          data:data,
          success:function(data){
           $('#listing_vente').html(data);
           document.getElementById('if_no_data').style.display="none";
           document.getElementById('client_info').style.display="none";
           list_on_load();
     
           newWin= window.open();
           newWin.document.write('je fais un test');
           newWin.document.close();
           newWin.focus();
           newWin.print();
           newWin.close();
          }
       });
}


// function retour(){
//   $.post("<?= base_url('produits/Produits')?>");
// }

   function client_info(id_mode_payement=0){

    if (id_mode_payement==2) {
     document.getElementById('client_info').style.display = "block"; 
     document.getElementById('hidden_line').style.display = "block"; 
     document.getElementById('hidden_montant').style.display = "block"; 
     document.getElementById('hidden_btn').style.display = "none"; 
    }else{
     document.getElementById('client_info').style.display = "none"; 
     document.getElementById('hidden_line').style.display = "none"; 
     document.getElementById('hidden_montant').style.display = "none"; 
     document.getElementById('hidden_btn').style.display = "block"; 
    }
    
   }


   $('#province_id').on('change',function(){
    var province_id=$(this).val();
    $.ajax({
        url:'<?= base_url()?>produits/Produits/get_all_communes',
        type:'post',
        data:{province_id:province_id},
        success:function(data){
          $('#commune_id').html(data);
        }
    });
 });

 $('#commune_id').on('change',function(){
    var commune_id=$(this).val();
    $.ajax({
        url:'<?= base_url()?>produits/Produits/get_all_zones',
        type:'post',
        data:{commune_id:commune_id},
        success:function(data){
          $('#zone_id').html(data);
        }
    });
 });

 $('#zone_id').on('change',function(){
    var zone_id=$(this).val();
    $.ajax({
        url:'<?= base_url()?>produits/Produits/get_all_collines',
        type:'post',
        data:{zone_id:zone_id},
        success:function(data){
          $('#colline_id').html(data);
        }
    });
 });
</script>
 