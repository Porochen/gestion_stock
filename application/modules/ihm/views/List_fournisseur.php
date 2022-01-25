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
                            <?php // print_r($cat)?> 
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                           <a href="<?= base_url("ihm/Fournisseur/Add_new")?>" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Nouvelle</a>
                        </div>
                     </div>
                       <?php if(!empty($this->session->flashdata('sms'))){   
                        echo $this->session->flashdata('sms'); } 
                     ?>
                     <div class="card-body rec-pat">
                        <div class="table-responsive">
                           <?= $this->table->generate($fnr) ?>
                        </div>
                     </div>
                  </div>
               </div>



      </div>
        <!-- Page end  -->
    </div>
</div>





<?php include VIEWPATH.'includes/footer.php' ;?>
