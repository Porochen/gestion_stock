
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
         <h4 class="card-title">Liste des produits dormants</h4>
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
             <h4 class="modal-title"><span id="titre"></span></h4>
          </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable' class='table table-bordered table-striped table-hover table-condensed' style ="width:100%;">        
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom du produit </th>
                  <th>Code produit</th>
                  <th>Prix unitaire d'achat</th>
                  <th>Prix unitaire de vente</th>  
                  <th>Quantite</th>
                  
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
// Create the chart
var chart = Highcharts.chart('container', {

      chart: {
      type: 'column'
    },

    title: {
      text: '<b> Produit dormants <br> Total=<?=$total ?>Kg</b>'
    },

    subtitle: {
      text: ''
    },

    legend: {
      align: 'center',
      verticalAlign: 'bottom',
      layout: 'vertical'
    },
    credits: {
      enabled: true,
      href: "",
      text: "UYC"
    },
    plotOptions: {
      column: {
       cursor:'pointer',
       depth: 25,
       point:{
        events: {
          click: function()
          {
                              

            $("#titre").html("Produit dormant:"+this.desc);
            $("#myModal").modal();
            var row_count ="1000000";
            $("#mytable").DataTable({
              "processing":true,
              "serverSide":true,
              "bDestroy": true,
              "oreder":[],
              "ajax":
              {
                 url:"<?=base_url('rapport/Rapport_produits_dormants/detail')?>",              
                type:"POST",
                data:
                {
                  key:this.key,
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
                         enabled: true
                       },
                       credits: {
                        enabled: true,
                        href: "",
                        text: "UYC"
                      },
                    }
                  },
                  xAxis: {
                    categories: [<?=$categorie?>],
                    labels: {
                      x: -10
                    }
                  },

                  yAxis: {
                    allowDecimals: false,
                    title: {
                      text: 'Quantité'
                    }
                  },

                  series:
                  [{
                name: 'Produit '+'(<?=$total?>)',
                    color: '#E50E39',
                    data: [<?=$donnees?>]

                  }],

                  responsive: {
                    rules: [{
                      condition: {
                        maxWidth: 500
                      },
                      chartOptions: {
                        legend: {
                          align: 'center',
                          verticalAlign: 'bottom',
                          layout: 'horizontal'
                        },
                        yAxis: {
                          labels: {
                            align: 'left',
                            x: 0,
                            y: -5
                          },
                          title: {
                            text: null
                          }
                        },
                        subtitle: {
                          text: null
                        },
                        credits: {
                          enabled: false
                        }
                      }
                    }]
                  }
                });
            
</script>


