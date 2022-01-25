<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>
 <div class="content-page">
    <div class="container-fluid">
      <div class="row">
      <div class="card card-block card-stretch card-height">
        <div class="card-header">
          <a href="<?= base_url('index.php/ihm/categorie')?>" class="btn btn-primary float-right">
            <i class="fa fa-list"></i> Liste
          </a>
          <h3><?=$title?></h3> 
        </div>
        <div class="card-body tdy-appoin">
         <form action="<?= base_url('index.php/ihm/categorie/add_new')?>" method="post">
          <div class="row">
            <div class="col-md-6">
              <label>Description</label> 
              <input name="descr_categorie" value="<?=set_value('descr_categorie')?>" class="form-control" placeholder="la description">
                 <font class="text-danger">
               <?=form_error('descr_categorie')?>
               </font>
            </div> 
            <div class="col-md-6 mt-4">
              <input type="submit" class="btn btn-primary float-right" value="Enregistrer">
            </div>
          </div>
         </form>  
        </div> 
      </div>
    </div>
    </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>
