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
         <h5 class="card-title ">Historique des soldes</h5>
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
  <div class="modal-dialog modal-lg" style ="width:1000px;">
        <!-- Modal -->
    <div class="modal-content  modal-lg" >
          <div class="modal-header">
             <h4 class="modal-title"><span id="titre"></span></h4>
          </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable' class='table table-bordered table-striped table-hover table-condensed'>        
              <thead>
                    <tr>
                      <th>#</th>
                      <th>NOM PRODUIT </th>
                      <th>PRIX UNITAIRE ANCIEN </th>
                      <th>PRIX UNITAIRE ACTUEL</th>
                      <th>DATE DE MODIFICATION</th>
                       
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
 
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Rapports des historique des soldes'
    },
    credits: {
      enabled: true,
      href: "",
      text: "UYC"
    },
    tooltip: {
        pointFormat: '{series.name}{point.percentage:.1f}%'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    
   plotOptions:
     {
      pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels:
             {
                enabled: true,
                format: '<b>{point.name}</b>{point.percentage:.1f} %'
            }
        },
        series: 
        {
            dataLabels:
             {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            },

            cursor: 'pointer',
            point: 
            {
                events: 
                { click: function()
          {
                              

            $("#titre").html("Historique des soldes: "+this.name);
            $("#myModal").modal();
            var row_count ="1000000";
            $("#mytable").DataTable({
              "processing":true,
              "serverSide":true,
              "bDestroy": true,
              "oreder":[],
              "ajax":
              {
                 url:"<?=base_url('rapport/Rapport_hist_soldes/detail')?>",              
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
            }
        }
        }
    ,
    series: [{
        name: '',
        colorByPoint: true,
      data: [<?= $serie ?>]
    }]
});

</script>


