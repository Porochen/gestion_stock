
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
         <h4 class="card-title">Historique approvisionnement des produits</h4>
       </div>
     </div>
     <div class="card-body rec-pat">
       <div class="panel-body">
        <div class="row">
          <div class="col-md-12" id="container"  style="border: 1px solid #d2d7db;"></div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
<!-- Page end  -->
</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-xl" >
        <!-- Modal -->
    <div class="modal-content  modal-xl" >
          <div class="modal-header">
             <h4 class="modal-title"><span id="title"></span></h4>
          </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable' class='table table-bordered table-striped table-hover table-condensed' style ="width:100%;">        
              <thead>
                    <tr>
                      <th>#</th>
                      <th>Quantite initiale</th>
                      <th>Quantite approvisionnee</th>
                      <th>Date d'insertion</th>
                    </tr>
              </thead>         
          </table>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>            
  </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>
<script type="text/javascript">
Highcharts.chart('container', {
  chart: {
    type: 'columnpyramid'
  },
  title: {
    
    text: '<b>Total=<?=$total1 ?> Kg</b>'

  },
  credits: {
      enabled: true,
      href: "",
      text: "UYC"
    },
  colors: ['#066DB5 ', '#066DB5 ', '#066DB5', '#066DB5', '#066DB5'],
  xAxis: {
    crosshair: true,
    labels: {
      style: {
        fontSize: '14px'
      }
    },
    type: 'category'
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Produit'
    }
  },
  tooltip: {
    valueSuffix: 'KG'
  },
  plotOptions: {
      columnpyramid: {
        cursor:'pointer',
        point:{
          events: {
           click: function()
           {
                          
                      $("#title").html("Historique approvisionnement :"+this.name);

                      $("#myModal").modal({
                            backdrop: 'static',
                            keyboard: false
                        });


                      var row_count ="1000000";
                      $("#mytable").DataTable({
                        "processing":true,
                        "serverSide":true,
                        "bDestroy": true,
                        "oreder":[],
                        "ajax":{
                          url:"<?=base_url('rapport/Rapport_hist_approv_produits/detail')?>",
                          type:"POST",
                          data:{
                            key:this.key
                          }
                        },
                        lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
                        pageLength: 10,
                        "columnDefs":[{
                          "targets":[],
                          "orderable":false
                        }],

                        dom: 'Bfrtlip',
                        buttons: [
                        'excel', 'print','pdf'
                        ],
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
                  }
                },
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.0f}',
                  connectorColor: 'silver'
                },
                showInLegend: true
              }
            },
  
  series: [{
    name: 'Produit',
    color:'red',
    data: [<?=$ser?>
    ],
    showInLegend: false
  }]
});
</script>


