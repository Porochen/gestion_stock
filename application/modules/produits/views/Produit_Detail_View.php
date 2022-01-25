<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

<style type="text/css">
body{
    color: #6c757d;
    background-color: #f5f6f8;
    margin-top:20px;
}
.card-box {
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e7eaed;
    padding: 1.5rem;
    margin-bottom: 24px;
    border-radius: .25rem;
}
.avatar-xl {
    height: 6rem;
    width: 6rem;
}
.rounded-circle {
    border-radius: 50%!important;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #1abc9c;
}
.nav-pills .nav-link {
    border-radius: .25rem;
}
.navtab-bg li>a {
    background-color: #f7f7f7;
    margin: 0 5px;
}
.nav-pills>li>a, .nav-tabs>li>a {
    color: #6c757d;
    font-weight: 600;
}
.mb-4, .my-4 {
    margin-bottom: 2.25rem!important;
}
.tab-content {
    padding: 20px 0 0 0;
}
.progress-sm {
    height: 5px;
}
.m-0 {
    margin: 0!important;
}
.table .thead-light th {
    color: #6c757d;
    background-color: #f1f5f7;
    border-color: #dee2e6;
}
.social-list-item {
    height: 2rem;
    width: 2rem;
    line-height: calc(2rem - 4px);
    display: block;
    border: 2px solid #adb5bd;
    border-radius: 50%;
    color: #adb5bd;
}

.text-purple {
    color: #6559cc!important;
}
.border-purple {
    border-color: #6559cc!important;
}

.timeline {
    margin-bottom: 50px;
    position: relative;
}
.timeline:before {
    background-color: #dee2e6;
    bottom: 0;
    content: "";
    left: 50%;
    position: absolute;
    top: 30px;
    width: 2px;
    z-index: 0;
}
.timeline .time-show {
    margin-bottom: 30px;
    margin-top: 30px;
    position: relative;
}
.timeline .timeline-box {
    background: #fff;
    display: block;
    margin: 15px 0;
    position: relative;
    padding: 20px;
}
.timeline .timeline-album {
    margin-top: 12px;
}
.timeline .timeline-album a {
    display: inline-block;
    margin-right: 5px;
}
.timeline .timeline-album img {
    height: 36px;
    width: auto;
    border-radius: 3px;
}
@media (min-width: 768px) {
    .timeline .time-show {
        margin-right: -69px;
        text-align: right;
    }
    .timeline .timeline-box {
        margin-left: 45px;
    }
    .timeline .timeline-icon {
        background: #dee2e6;
        border-radius: 50%;
        display: block;
        height: 20px;
        left: -54px;
        margin-top: -10px;
        position: absolute;
        text-align: center;
        top: 50%;
        width: 20px;
    }
    .timeline .timeline-icon i {
        color: #98a6ad;
        font-size: 13px;
        position: absolute;
        left: 4px;
    }
    .timeline .timeline-desk {
        display: table-cell;
        vertical-align: top;
        width: 50%;
    }
    .timeline-item {
        display: table-row;
    }
    .timeline-item:before {
        content: "";
        display: block;
        width: 50%;
    }
    .timeline-item .timeline-desk .arrow {
        border-bottom: 12px solid transparent;
        border-right: 12px solid #fff !important;
        border-top: 12px solid transparent;
        display: block;
        height: 0;
        left: -12px;
        margin-top: -12px;
        position: absolute;
        top: 50%;
        width: 0;
    }
    .timeline-item.timeline-item-left:after {
        content: "";
        display: block;
        width: 50%;
    }
    .timeline-item.timeline-item-left .timeline-desk .arrow-alt {
        border-bottom: 12px solid transparent;
        border-left: 12px solid #fff !important;
        border-top: 12px solid transparent;
        display: block;
        height: 0;
        left: auto;
        margin-top: -12px;
        position: absolute;
        right: -12px;
        top: 50%;
        width: 0;
    }
    .timeline-item.timeline-item-left .timeline-desk .album {
        float: right;
        margin-top: 20px;
    }
    .timeline-item.timeline-item-left .timeline-desk .album a {
        float: right;
        margin-left: 5px;
    }
    .timeline-item.timeline-item-left .timeline-icon {
        left: auto;
        right: -56px;
    }
    .timeline-item.timeline-item-left:before {
        display: none;
    }
    .timeline-item.timeline-item-left .timeline-box {
        margin-right: 45px;
        margin-left: 0;
        text-align: right;
    }
}
@media (max-width: 767.98px) {
    .timeline .time-show {
        text-align: center;
        position: relative;
    }
    .timeline .timeline-icon {
        display: none;
    }
}
.timeline-sm {
    padding-left: 110px;
}
.timeline-sm .timeline-sm-item {
    position: relative;
    padding-bottom: 20px;
    padding-left: 40px;
    border-left: 2px solid #dee2e6;
}
.timeline-sm .timeline-sm-item:after {
    content: "";
    display: block;
    position: absolute;
    top: 3px;
    left: -7px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #1abc9c;
}
.timeline-sm .timeline-sm-item .timeline-sm-date {
    position: absolute;
    left: -104px;
}
@media (max-width: 420px) {
    .timeline-sm {
        padding-left: 0;
    }
    .timeline-sm .timeline-sm-date {
        position: relative !important;
        display: block;
        left: 0 !important;
        margin-bottom: 10px;
    }
}

</style>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">


    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />


<div class="container">
<div class="row">
    <div class="col-lg-4 col-xl-4">
        <div class="card-box text-center">
            <?php
            $img_product = '';

            if (!empty($produit_info['image'])) { 

                $img_product='
                <img width="50" height="50" src="'.base_url('assets/images/produits/'.$produit_info['image']).'" alt="Image product" style="border-radius: 50%">';
            }else{ 
                $img_product='<h4 class="text-center">Pas d\'image</h4>';
            }

            echo $img_product;  

            ?>

            <h4 class="mb-0"><?=$produit_info['nom_produit']?></h4>

            <div class="text-left mt-3">
                <p class="text-muted mb-2 font-13"><strong>Catégorie :</strong> <span class="ml-2"><?=$produit_info['descr_categorie']?></span></p>

                <p class="text-muted mb-2 font-13"><strong>Sous catégorie :</strong><span class="ml-2"><?=$produit_info['descr_sous_categorie']?></span></p>

                <p class="text-muted mb-2 font-13"><strong>Quantité :</strong> <span class="ml-2 "><?=$produit_info['quantite_restante']?></span></p>

                <p class="text-muted mb-1 font-13"><strong>Prix d'achat :</strong> <span class="ml-2"><?=$produit_info['prix_unitaire_achat']?></span></p>
                <p class="text-muted mb-1 font-13"><strong>Prix de vente :</strong> <span class="ml-2"><?=$produit_info['prix_unitaire_vente']?></span></p>
            </div>
        </div> <!-- end card-box -->

        <div class="card-box">
            <h4 class="header-title">Progression de vente</h4>
           

          

            <div class="mt-2 pt-1">
                <h6 class="text-uppercase"><?=$produit_info['nom_produit']?> <span class="float-right">67%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%">
                        <span class="sr-only">67% Complete</span>
                    </div>
                </div>
            </div>

            <div class="mt-2 pt-1">
                <h6 class="text-uppercase">Tomate <span class="float-right">48%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%">
                        <span class="sr-only">48% Complete</span>
                    </div>
                </div>
            </div>

            <div class="mt-2 pt-1">
                <h6 class="text-uppercase">cocacola <span class="float-right">95%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                        <span class="sr-only">95% Complete</span>
                    </div>
                </div>
            </div>


        </div> <!-- end card-box-->

    </div> <!-- end col-->

    <div class="col-lg-8 col-xl-8">
        <div class="card-box">
            <ul class="nav nav-pills navtab-bg">
                <li class="nav-item">
                    <a href="#Produit" data-toggle="tab" aria-expanded="true" class="nav-link ml-0 active">
                        <font class="fa fa-shopping-bag"></font> Produit
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#hist" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-cards-variant mr-1"></i>Historique
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                
                <div class="tab-pane show active" id="Produit">

                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-briefcase mr-1"></i>
                        Dernière vente: <b style="color:red"><?=$produit_info['nom_produit']?></b></h5>

                    <ul class="list-unstyled timeline-sm">
                        <?php foreach ($last_sell as $value) { ?>

                        <li class="timeline-sm-item">
                            <span class="timeline-sm-date"><?=$value['date_insertion']?><br><?=$value['heure_insertion']?></span>
                            <p class="text-muted mb-2 font-13"><strong>Quantité vendue:</strong> <span class="ml-2"><?=$value['quantite_vendue']?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>Montant payé :</strong><span class="ml-2"><?=$value['montant_paye']?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Mode paiement:</strong><span class="ml-2"><?=$value['payement_desc']?></span></p>

                        </li>

                        <?php } ?>
                    </ul>
                </div>
                <!-- end timeline content-->

                <div  id="hist">
                    <h5 class="mb-3 mt-4 text-uppercase">
                        <i class="mdi mdi-cards-variant mr-1"></i>
                        Historique approvisionnement :<b style="color:blue"> <?= $produit_info['nom_produit']?> </b>
                    </h5>
                    <div class="table-responsive" >
                        <table id='get_hist' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>QTE INITIALE</th>
                            <th>QTE APPROV.</th>
                            <th>PRIX D'ACHAT</th>
                            <th>PRIX DE VENTE</th>
                            <th>FOURNISSEUR</th>
                            <th>DATE</th>
                          </tr>
                        </thead>

                      </table>
                    </div>
                </div>
                <!-- end settings content-->

            </div> <!-- end tab-content -->
        </div> <!-- end card-box-->

    </div> <!-- end col -->
</div>
</div>






      </div>
    </div>
</div>





<?php include VIEWPATH.'includes/footer.php' ;?>


<script type="text/javascript">
 $(document).ready(function(){
    get_hist();
     
    });
 </script>

<script type="text/javascript">
function get_hist() 
{  
   $("#get_hist").DataTable({
    "destroy" : true,
    "processing":true,
    "serverSide":true,
    "oreder":[],
    "ajax":{
      url: "<?=base_url('produits/Produits/hist_approv/').$produit_info['id_produit'];?>", 
      type:"POST",
      data : {   },
      beforeSend : function() {
      }
    },
    lengthMenu: [[5,10,50, 100, -1], [5,10,50, 100, "All"]],
    pageLength: 5,
    "columnDefs":[{
      "targets":[],
      "orderable":false
    }],
    dom: 'Bfrtlip',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
    language: {
      "sProcessing":     "Traitement en cours...",
      "sSearch":         "Rechercher&nbsp;:",
      "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
      "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
      "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
      "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
      "sInfoPostFix":    "",
      "sLoadingRecords": "Chargement en cours...",
      "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
      "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
      "oPaginate": {
        "sFirst":      "Premier",
        "sPrevious":   "Pr&eacute;c&eacute;dent",
        "sNext":       "Suivant",
        "sLast":       "Dernier"
      },
      "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
      }
    }
  });


 }
</script>
