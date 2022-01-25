<style type="text/css">
  h5,p{
    font-size:14px;
  }
  #option li{
   list-style-type: none;
  }



  @media (max-width: 767px) {

  #all_button{
    margin-top:10px;
  }
  #all_button li{
    display: inline;
    padding: 10px;
  }

  #hidden_nouveau{
    font-size: 20px;
  }
  #title{
    font-size: 14px;
  }
  #hidden_nouveau{
    display:none;
    margin-top: -10px;
  }

}



@media only screen and (max-width: 300px) {
  #option{
    margin-top:10px;
    margin-left:-20px;
    float:left;
  }
    #all_button li{
    display: inline;
    margin-right:2px;
    
  }
  #title{
    font-size: 14px;
  }
  #hidden_nouveau{
    display:none;
    margin-top: -10px;
    font-size:10px;
  }
}

</style>

<?php
      if (1==1) {
        $hr='none';
        $fhr='block';
        $cart='block';
        $prix_achat='none';
        $all_button='style="display:none;"';
        $cart_button='style="display:block;"';
      }else{
        $hr='block';
        $fhr='none';
        $cart='none';
        $prix_achat='block';
        $all_button='style="display:block;"';
        $cart_button='style="display:none;"';
      }
?>
<?php foreach ($produit_info as $value) { ?>

<div class="container-fluid">
    <div class="main-body">


        <div class="card">
          <div class="col-md-12">
            <div class="row">
             <div class="card-body">

          <div class="row gutters-sm">
            <div class="col-md-3 mb-0" id="image">
              <div class="d-flex flex-column align-items-center text-center">

<?php
$img_product = '';

if (!empty($value['image'])) { 

$img_product='
 <img width="50" height="50" src="'.base_url('assets/images/produits/'.$value['image']).'" alt="Image product" style="border-radius: 50%">';
    }else{ 
$img_product='<h4 class="text-center">Pas d\'image</h4>';
 }

 echo $img_product;  

?>
                <div class="mt-3">
                  <h6><?=$value['descr_categorie']?><BR> 
                    <b><?=$value['descr_sous_categorie']?></b></h6>
                  <p class="text-secondary mb-1">
                     Quantité 
                   
                <?php  if ($value['quantite_restante']<10) {
                        $color="color: red;font-size: 15px;";

                 }else{
                         $color="color: green;font-size: 15px;";
                 } ?>
                  <a hre="#" data-toggle="modal" data-target="#approv<?= $value['id_produit']?>" class="btn btn-sm btn-block" title="Approvisionner">
                    <b style="<?= $color ?>"><?=$value['quantite_restante']?></b>
                  </a>

                   </p>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="row">
                <div class="col-sm-3">
                  Produit
                </div>
                <div class="col-sm-9 text-secondary">
                  <b><?=$value['nom_produit']?></b>
                </div>
              </div>
              <hr style="display:<?=$hr?>">
              <div class="row">
                <div class="col-sm-3" style="display:<?=$prix_achat?>">
                  Prix d'achat
                </div>
                <div class="col-sm-9 text-secondary" style="display:<?=$prix_achat?>">
                  <b><?=$value['prix_unitaire_achat']?></b>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  Prix de vente
                </div>
                <div class="col-sm-9 text-secondary">
                  <b><?=$value['prix_unitaire_vente']?></b>
                </div>
              </div>
              <hr style="display:<?=$fhr?>">
              <div class="row">
                <div class="col-sm-3" style="display:<?=$cart?>">
                  Quantité
                </div>
                <div class="col-sm-9 text-secondary" style="display:<?=$cart?>">
<!-- #################< info de la table tempo >############ -->
                 <input type="number" name="quantite_vendue" id="quantite_vendue<?=$value['id_produit']?>" value="1" class="form-control">
                 <font class="text-center text-danger" id="error_quantite<?=$value['id_produit']?>"></font>

                 <input type="hidden" id="quantite_reel<?=$value['id_produit']?>" value="<?=$value['quantite']?>" class="form-control">

                  <input type="hidden" id="produit<?=$value['id_produit']?>" value="<?=$value['nom_produit']?>">
                  <input type="hidden" id="image<?=$value['id_produit']?>" value="<?=$value['image']?>">
                  <input type="hidden" id="prix_unitaire<?=$value['id_produit']?>" value="<?=$value['prix_unitaire_vente']?>">
<!-- #################< info de la table tempo >############ -->

                </div>
              </div>
            </div>

            <div class="col-md-2" id="all_button" style="vertical-align: middle;">
              <ul id="option">
                <li class="pr-2 pb-2" <?=$cart_button?>>
                  <a href="javascript:void(0)"  title="Vendre" class="vente" id="<?=$value['id_produit']?>">
                    <input type="hidden" id="cart_value<?=$value['id_produit']?>" value="0">
                    <i class="fa fa-cart-plus text-info" id="fafa<?=$value['id_produit']?>"></i>
                  </a>
                </li>
                <li class="pr-2 pb-2" <?=$all_button?>>
                 <a href="<?= base_url('produits/Produits/detail/'.$value['id_produit'])?>"  title="Tableau de bord">
                  <i class="fa fa-list"></i>
                </a>
                </li>
                <li class="pr-2 pb-2"<?=$all_button?>>
                  <a href="<?=base_url('produits/Produits/update_view/'.$value['id_produit'])?>"  title="Editer">
                    <i class="fa fa-edit"></i>
                  </a>
                </li>
                <li class="pr-2 pb-2"<?=$all_button?>>
                  <a href="#"  title="Supprimer" class="delete" data-target="#delete<?= $value['id_produit']?>" data-toggle="modal">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </li>
              </ul> 
            </div>

              </div>

              
              
            </div>


          </div>


             </div> 
            </div>
          </div>
        </div>
      </div>
    </div><hr id="ligne">




<div class="modal fade" id="delete<?= $value['id_produit']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="text-danger">
          Voullez-vous supprimer <strong><?= $value['nom_produit']?></strong> ?
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <form action="<?= base_url('produits/Produits/delete/'.$value['id_produit'])?>" method="post">
          <button type="submit" class="btn btn-sm btn-danger">
          Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JEAN DE DIEU -->


<div class="modal fade" id="approv<?= $value['id_produit']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center" style="font-size:18px">Approvisionner : <b class="text-success"><?=$value['nom_produit']?></b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('produits/Produits/approvisionner/'.$value['id_produit'])?>" method="post">

          <div class="row">
            <div class="col-md-12">
              <label>Nombre ajoutés</label> 
              <input type="number" class="form-control" name="quantite_ajoutee" required placeholder="quantite ajoutés">
            </div>
            <div class="col-md-12">
              <label>Prix d'achat unitaire</label> 
              <input type="number" class="form-control" name="prix_unitaire_achat" required placeholder="Prix d'achat unitaire">
            </div>
            <div class="col-md-12">
              <label>Prix de vente</label> 
              <input type="number" class="form-control" name="prix_unitaire_vente" required placeholder="Prix de vente">
            </div>
            <div class="col-md-12">
              <label>Fournisseur</label> 
              <select name="id_fournisseur" class="form-control">
                <option value="">Sélectionner</option>
                <?php 
                  foreach ($fournisseur as $value) { ?>
                    <option value="<?=$value['id_fournisseur']?>"><?=$value['nom_fournisseur'].' '.$value['prenom_fournisseur']?></option>
                    
                <?php  } ?>
                
              </select>
            </div>

          </div><br>
            <div class="modal-footer">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary">
                  Approvisionner
                </button>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php } ?>











<div class="modal fade" id="detai_info" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2"><b style="color: black">modal detail</b></h5>
        <button type="button"data-dismiss="modal">X</button>
      </div>
      <div class="modal-body">
        <div class="data"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="vente00" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form action="#" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="all_cart_data"></div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary float-right" value="Enregistrer & Imprimer">
      </div>
      </form>
    </div>
  </div>
</div>








<script>

 function listing_to_card(){
  // $.ajax({
  //         type:'post',
  //         url:'<?=base_url()?>produits/Produits/listing_to_card',
  //         data:{},
  //         success:function(data){
  //           if (data=='') {
  //           $('#cart_detail_header').html('<h6 class="text-center text-danger">no data found</h6>');
  //           }else{
  //             $('.total_cart').html(data.total);
  //             $('#cart_detail_header').html(data.output);
  //           }
  //         }
  //      });
 }


 $('#cart_detail_header').load('<?=base_url()?>produits/Produits/load_cart',function(response, status, xhr){
    if (status=='success') {

      var obj = JSON.parse(response);
      $('.total_cart').html(obj.total);
      $('#cart_detail_header').html(obj.output);
    }
 });

</script>



















<script type="text/javascript">
  $('.vente').on('click',function(){
    var id_produit=$(this).attr('id');
    var produit=$('#produit'+id_produit).val();
    var quantite=$('#quantite_vendue'+id_produit).val();
    var prix_unitaire=$('#prix_unitaire'+id_produit).val();
    var image=$('#image'+id_produit).val();
    var cart_value=$('#cart_value'+id_produit).val();
    
    var quantite_reel=$('#quantite_reel'+id_produit).val();

    var url;
    var data;


    if (cart_value==0) {
       document.getElementById('fafa'+id_produit).className="fa fa-check";
       $('#cart_value'+id_produit).val(1);
       url='<?=base_url()?>produits/Produits/add_to_cart';
       data={id_produit:id_produit,produit:produit,quantite:quantite,prix_unitaire:prix_unitaire,image:image};    
    } else{
        document.getElementById('fafa'+id_produit).className="fa fa-cart-plus text-info";
        $('#cart_value'+id_produit).val(0);
        url='<?=base_url()?>produits/Produits/remove_to_cart'; 
        data={id_produit:id_produit};
    }

    // if (quantite!=quantite_reel) {
    //   alert('ok')
    // }

    if (quantite!=0 && quantite>0 && (quantite<=quantite_reel)) {

    $('#quantite_vendue'+id_produit).css('border-color','');
    $('#error_quantite'+id_produit).html('');

    $.ajax({
           type:'post',
           url:url,
           data:data,
           dataType:'json',
           // processData: false,
           success:function(data){
             if (data.total!=0) {
              $('.total_cart').html(data.total);
              $('#cart_detail_header').html(data.output);
             }else{
              $('.total_cart').html(data.total);
              $('#cart_detail_header').html('<h6 class="text-center text-danger">no data found</h6>');
             }
           }
        });

    }else if(quantite==0||quantite<0){
        $('#quantite_vendue'+id_produit).focus();
        $('#quantite_vendue'+id_produit).css('border-color','red');
        $('#error_quantite'+id_produit).html('Quantité incorrecte');
    }else if(quantite > quantite_reel){
      $('#quantite_vendue'+id_produit).focus();
      $('#quantite_vendue'+id_produit).css('border-color','red');
      $('#error_quantite'+id_produit).html('Quantité superieur a la qté stocké');
    }


 });


 $(document).load('<?=base_url()?>produits/Produits/load_cart',function(response, status, xhr){
    if (status=='success') {

      var obj = JSON.parse(response);
      var id_produit;

      for (var i = 0; i < obj.length; i++) {
        id_produit=obj[i];
       document.getElementById('fafa'+id_produit).className="fa fa-check";
       $('#cart_value'+id_produit).val(1);
      }

      list_on_load();
    }
 });



</script>