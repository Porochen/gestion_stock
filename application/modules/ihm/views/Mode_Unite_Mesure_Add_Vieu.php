<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
         <h3><? =$title?></h3>
          <a href="<?= base_url("ihm/Mode_Unite_Mesure")?>" class="btn btn-outline-primary float-right"><i class="fa fa-list"></i> Liste</a>
         
        </div> 
         

        <div class="card-body tdy-appoin">
          
             <form action="<?= base_url('ihm/Mode_Unite_Mesure/save')?>" method="POST">
           <div class="row">
             <div class="col-md-6">
               <label>unite mesure</label>
               <input type="text" name="unite_mesure" class="form-control " />
             </div>
             <div class="col-md-6 mt-4">
                 <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Ajouter</button>
               </div>
           </div>
               
                
               

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    
  
          </form>
        </div> 
      </div>
    </div>
    </div>
</div>

<?php include VIEWPATH.'includes/footer.php' ;?>
