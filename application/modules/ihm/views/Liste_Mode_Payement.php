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
                           <a href="<?= base_url("ihm/Mode_Paiment/add")?>" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Nouvelle</a>
                        </div>
                     </div>
                     <div class="card-body rec-pat">
                      <div>
                      <?php if(!empty($this->session->flashdata('sms'))){   
                        echo $this->session->flashdata('sms'); } 
                     ?>
                    </div>
                        <div class="table-responsive">
                           <?= $this->table->generate($cat) ?>
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
         $('#sms').delay(5000).hide('slow');
          $("#mytable").DataTable({
                
             language: {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher MENU &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment START &agrave; END sur TOTAL &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de MAX &eacute;l&eacute;ments au total)",
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
            },                
                dom: 'Bfrtlip',
        buttons: [
              
               {
               extend: 'copy',
               exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
               },
               {
               extend: 'csv',
               exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
               }, 
               { 
               extend: 'excel',
               exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
               },
               {
               extend: 'pdf',
               exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
               },
               {
               extend: 'print',
               exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
               } 
           ]          
        });
    });

    </script>
