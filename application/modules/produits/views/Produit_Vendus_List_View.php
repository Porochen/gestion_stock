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
          <h3>Liste des Produits vendus</h3> 
        </div>
        <div class="card-body tdy-appoin">
          <div class="table-responsive" >
                        <table id='get_hist' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>PRODUIT</th>
                            <th>CODE PRODUIT</th>
                            <th>QTE VENDUE</th>
                            <th>MONTANT PAYE</th>
                            <th>MONTANT RESTANT</th>
                            <th>MODE PAIEMENT</th>
                            <th>DATE</th>
                          </tr>
                        </thead>

                      </table>
                    </div>
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
      url: "<?=base_url('produits/Produits_Vendus/listing/');?>", 
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
