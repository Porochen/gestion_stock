
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
         <h4 class="card-title"><?=$title?></h4>
       </div>

     </div>
<div class="table table-responsive">
     <div class="card-body rec-pat">
       <div class="panel-body">
        <div class="row">
          <div class="col-md-12" id="container1"  style="border: 1px solid #d2d7db;"></div>
          <div class="col-md-6" id="container2"  style="border: 1px solid #d2d7db;"></div>
          <div class="col-md-6" id="container3"  style="border: 1px solid #d2d7db;"></div>
          <div class="col-md-6" id="container4"  style="border: 1px solid #d2d7db;"></div>
          <div class="col-md-6" id="container5"  style="border: 1px solid #d2d7db;"></div>
        </div>

      </div>
    </div>
    </div>
  </div>
</div>


</div>
<!-- Page end  -->
</div>
</div>

<!-- MODAL POUR LES PA PV VENDUS ET BENEFICES -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="vente">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title"></h4>
      </div>
      <div class="col-xl-12">
      <div class="modal-body">
         
        <div class="table-responsive">
          <table id='mytable_vendu' class='table table-bordered table-striped table-hover table-condensed' style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>QTE VENDUE</th>
                <th>MONTANT PAYE</th>
                <th>SOLDE RESTANTE</th>
                <th>MODE PAYEMENT</th>
                <th>DATE DE PAYEMENT</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>



<!-- MODAL POUR LES PRODUITS STOCKES -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="stock">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title1"></h4>
      </div>
      <div class="col-xl-12">
      <div class="modal-body">
         
        <div class="table-responsive">
          <table id='mytable_stock' class='table table-bordered table-striped table-hover table-condensed' style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>QTE INITIALE</th>
                <th>QTE APPROVISIONNEE</th>
                <th>FOURNISSEUR</th>
                <th>P.A UNITAIRE</th>
                <th>P.V UNITAIRE</th>
                <th>DATE APPROV</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>




<!-- MODAL POUR LES PRODUITS RESTANTS -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="restant">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title2"></h4>
      </div>
      <div class="col-xl-12">
      <div class="modal-body">
         
        <div class="table-responsive">
          <table id='mytable_reste' class='table table-bordered table-striped table-hover table-condensed' style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>QTE INITIALE</th>
                <th>QTE APPROVISIONNEE</th>
                <th>FOURNISSEUR</th>
                <th>P.A UNITAIRE</th>
                <th>P.V UNITAIRE</th>
                <th>DATE APPROV</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
           


<?php include VIEWPATH.'includes/footer.php' ;?>

<script type="text/javascript">
    Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<b>Produits achetés-vendus et leurs bénéfices</b>'
    },
    credits: {
                enabled: true,
                href: "",
                text: "UYC"
              },
    xAxis: {
        categories: [<?=$categorie?>],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Quantité'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
  
        cursor:'pointer',
        point:{
          events: {
            click: function()
            {
              $("#title").html("Historique des ventes: "+this.desc);

              $("#vente").modal({
        backdrop: 'static',
        keyboard: false
    });
              var row_count ="1000000";
              $("#mytable_vendu").DataTable({
                "processing":true,
                "serverSide":true,
                "bDestroy": true,
                "oreder":[],
                "ajax":{
                  url:"<?=base_url('rapport/Dashboard/detail_vendu')?>",
                  type:"POST",
                  data:{
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
          enabled: true,
          format: '{point.y:.0f}',
          connectorColor:'red'
        },
        showInLegend: true
        }
    },
    series: [{
                name: 'P.A'+'(<?= $achats_total ?>) ',
                color: 'green',
                data: [<?= $donnees_achats ?>]
              },
               {
                name: 'P.V'+'(<?= $vend_total ?>)',
                color: 'blue',
                data: [<?= $donnees_vend ?>]
              },
               {
                name: 'Vendus'+'(<?= $paye_total ?>)',
                color: 'purple',
                data: [<?= $donnees_paye ?>]
              },{
                name: 'Bénéfice'+'(<?= $benefice_total ?>) ',
                color: 'red',
                data: [<?= $donnees_ben ?>]
              }]
});

</script>

<script type="text/javascript">
  Highcharts.chart('container2', {
    chart: {
      type: 'columnpyramid',

    },
    title: {
      text: '<b> Produits stockés <br> Total=<?=number_format($total1,0,',',' ') ?></b>'
    },
    colors: ['#C79D6D', '#B5927B', '#CE9B84', '#B7A58C', '#C7A58C'],
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
        text: ''
      }
    },
    tooltip: {
      valueSuffix: ' '
    },
    plotOptions: {
      columnpyramid: {
        cursor:'pointer',
        point:{
          events: {
           click: function()
           {
                          
                      $("#title1").html("Historique approvisionnement :"+this.desc);

                      $("#stock").modal({
                            backdrop: 'static',
                            keyboard: false
                        });


                      var row_count ="1000000";
                      $("#mytable_stock").DataTable({
                        "processing":true,
                        "serverSide":true,
                        "bDestroy": true,
                        "oreder":[],
                        "ajax":{
                          url:"<?=base_url('rapport/Dashboard/detail_stock')?>",
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
            credits: {
              enabled: true,
              href: "",
              text: "UYC"
            },

            series: [{
              name: 'Produit'+'(<?=$total1?>)',
              color: 'purple',
              data: [<?= $donnees1?>]
            }]
          });
</script>




 <script type="text/javascript">
  Highcharts.chart('container3', {
    chart: {
      type: 'columnpyramid',

    },
    title: {
      text: '<b> Produits restants <br> Total=<?=number_format($total2,0,',',' ') ?></b>'
    },
    colors: ['#C79D6D', '#B5927B', '#CE9B84', '#B7A58C', '#C7A58C'],
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
        text: ''
      }
    },
    tooltip: {
      valueSuffix: ' '
    },
    plotOptions: {
      columnpyramid: {
        cursor:'pointer',
        point:{
          events: {
           click: function()
           {

                        $("#title2").html("Historique approvisionnement: "+this.desc);

                        $("#restant").modal({
                          backdrop: 'static',
                          keyboard: false
                        });
                        var row_count ="1000000";
                        $("#mytable_reste").DataTable({
                          "processing":true,
                          "serverSide":true,
                          "bDestroy": true,
                          "oreder":[],
                          "ajax":{
                            url:"<?=base_url('rapport/Dashboard/detail_stock')?>",
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
              credits: {
                enabled: true,
                href: "",
                text: "UYC"
              },

              series: [{
                name: 'Produit'+'(<?=$total2?>)',
                color: 'olive',
                data: [<?= $donnees2?>]
              }]
            });
  </script>

  <script type="text/javascript">
    
    // Build the chart
Highcharts.chart('container4', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>Dettes enregistrées sur les produits vendus</b>'
    },
    subtitle:
        {
            text: 'Total=<?=$tot?>'
        },
    credits: {
                enabled: true,
                href: "",
                text: "UYC"
              },
    tooltip: {
      valueSuffix: ''
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Dette (en Fbu)',
        colorByPoint: true,
        data: [<?= $serie ?>]
    }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('container5', {
    chart: {
        type: 'line'
    },
    title: {
        text: '<b>Total enregistré en 2021</b>'
    },
    xAxis: {
        categories: [<?=$categorie_evol?>],
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Evolution'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'PA',
        data: [<?= $donnee_evol_pa?>]
    },{
        name: 'PV',
        data: [<?= $donnee_evol_pv?>]
    }]
});
</script>

