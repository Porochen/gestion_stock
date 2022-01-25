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
             <h4 class="card-title"><?= $title ?></h4>
         </div>
     </div>
     <div class="card-body rec-pat">


        <div class="container-fluid">
          <div class="row">

            <div class="col-sm-6 col-md-4">
                <div class="panel panel-success col-h">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-heading">Site Logo</div>
                        </div>
                        <div class="col-md-6 ">
                            <center><button type='button' class='btn btn-xs text-center' data-toggle='modal' data-target='#photo'></i><img src="<?= base_url() ?>/upload/settings_images/<?=$logo?>" alt="Logo is deleted. Upload new!" class="img-responsive" style="height: 60px;width: 60px;"></button></center>
                        </div>
                    </div><hr>

                    <form accept-charset="utf-8" method="post" enctype="multipart/form-data" action="<?= base_url('administration/Settings/update_logo')?>">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file"  class="form-control" name="sitelogo" size="20" />
                            </div>
                            <div class="col-md-12 mt-4">
                                <input type="submit" value="Upload New" name="uploadimage" class="btn btn-outline-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-sm-6 col-md-4">
                <div class="panel panel-success col-h">
                    <div class="panel-heading">Nom de l'application</div>
                    <div class="panel-body">
                        <form method="POST" action="<?= base_url('administration/Settings/update_nameapk')?>">
                           <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" name="name_apk" value="<?= $name_apk;?>" type="text">
                            </div>
                            <div class="col-md-12 mt-4">
                                <input type="submit" value="Update" name="uploadimage" class="btn btn-outline-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-md-4">
            <div class="panel panel-success col-h">
                <div class="panel-heading">Thème de l'application</div>
                <div class="panel-body">
                    <form method="POST" action="<?= base_url('administration/Settings/update_themeapk')?>">
                      <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name="theme_apk" value="<?= $theme_apk;?>" type="text">
                        </div>
                        <div class="col-md-12 mt-4">
                            <input type="submit" value="Update" name="uploadimage" class="btn btn-outline-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="panel panel-success col-h">
            <div class="panel-heading">Nom de l'imprimante</div>
            <div class="panel-body">
                <form method="POST" action="<?= base_url('administration/Settings/update_imprimante')?>">
                 <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" name="name_imprimante" value="<?= $name_imprimante;?>" type="text">
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="submit" value="Update" name="uploadimage" class="btn btn-outline-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="col-md-8">
    <div class="panel panel-success">
        <div class="panel-body">
            <form method="POST" action="<?= base_url('administration/Settings/update_proprietaire')?>">
               <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Propriataire">Propriataire/Société</label>
                        <input type="text" style="padding-left:25px;" class="form-control" name="name_societe" value="<?=$name_societe;?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Adresse">Localisation/Adresse</label>
                        <input type="text" style="padding-left:25px;" class="form-control" name="localite" value="<?=$localite;?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Téléphone">Téléphone</label>
                        <input type="text" style="padding-left:25px;" class="form-control" name="phone" value="<?=$phone;?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" style="padding-left:25px;" class="form-control" name="email" value="<?=$email;?>">
                    </div>
                </div>
            </div>


        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" name="contacts" value="Update">
        </div>
    </form>
</div>
</div>
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

 <div id='photo' class='modal fade'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            
            <div class='modal-body'>
                <center><img style='height: 300px;width: 300px;' src='<?=base_url('/upload/settings_images/').$logo ?>' class='img-circle' alt="PAS D'IMAGE"/></center> 
            </div>
        </div>
    </div>
</div>
<?php include VIEWPATH.'includes/footer.php' ;?>


