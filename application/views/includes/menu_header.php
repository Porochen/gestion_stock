<style type="text/css">
  .scroll{
    position:relative;
    width:100%;
    height:auto;
    max-height:300px;
    overflow:auto;
   }
</style>
<div class="iq-top-navbar">
  <div class="iq-navbar-custom">
     <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
           <i class="ri-menu-line wrapper-menu"></i>
           <a href="#" class="header-logo">
              <!-- <img src="<?= base_url()?>assets/images/logo/UYC.png" class="img-fluid rounded-normal" alt="logo"> -->
           </a>
        </div>


<!-- ############< menu pour stock >############ -->
<?php 

  $class=$this->router->fetch_class();

  if($this->current_cm->current_class()=='stock'){   ?>

        <ul class="nav nav-tabs" id="myTab-1" role="tablist">

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Produits') echo 'active';?>" id="profile-tab" href="<?=base_url('produits/Produits')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-shopping-bag"></font> Produits</a>
          </li>

          <li class="nav-item">
             <a class="nav-link" id="profile-tab" href="#" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-cart-arrow-down"></font> Achats</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Produits_Vendus') echo 'active';?>" id="profile-tab" href="<?=base_url('produits/Produits_Vendus')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-shopping-basket"></font> Produits vendus</a>
          </li>

          <li class="nav-item">
             <a class="nav-link " id="profile-tab" href="#" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-comments-dollar"></font> Dettes</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Fournisseur') echo 'active';?>" id="profile-tab" href="<?=base_url('ihm/Fournisseur')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-users-cog"></font> Fournisseurs</a>
          </li>


          <li class="nav-item">
             <a class="nav-link " id="home-tab" href="#" role="tab"><font class="fa fa-users"></font> Clients</a>
          </li>
      </ul> 
<?php } ?>
<!-- ############<! menu pour stock >############ -->


<!-- ############< menu pour reporting >############ -->
<?php   if($this->current_cm->current_class() == 'Reporting'){   ?>

        <ul class="nav nav-tabs" id="myTab-1" role="tablist">

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Rapport_produits_dormants') echo 'active';?>" id="profile-tab" href="<?=base_url('rapport/Rapport_produits_dormants')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-box-open"></font> Produsts dormant</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Rapport_produits_vendus') echo 'active';?>" id="profile-tab" href="<?=base_url('rapport/Rapport_produits_vendus')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-shopping-basket"></font> Produits vendus</a>
          </li>

          <li class="nav-item">
             <a class="nav-link " id="profile-tab" href="#" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-comments-dollar"></font> Dettes</a>
          </li>

          <li class="nav-item">
            <div class="dropdown">
             <a class="nav-link <?php if($class == 'Rapport_hist_soldes' || $class == 'Rapport_hist_fact_produits') echo 'active';?>" id="home-tab" href="#" role="tab" data-toggle="dropdown"><font class="fa fa-history"></font> Historique</a>

             <div class="dropdown-menu  dropdown-content">
                <a class="dropdown-item <?php if($class == 'Rapport_hist_soldes') echo 'active';?>" href="<?=base_url('rapport/Rapport_hist_soldes')?>">Solde</a>
                <a class="dropdown-item <?php if($class == 'Rapport_hist_fact_produits') echo 'active';?>" href="<?=base_url('rapport/Rapport_hist_fact_produits')?>">Facturation</a>
                <a class="dropdown-item" href="#">Payement</a>
                <a class="dropdown-item" href="#">Bénéfice</a>
                <a class="dropdown-item" href="#">Prouits annulés</a>
              </div>
            </div>

          </li>
      </ul> 
<?php } ?>
<!-- ############<! menu pour reporting >############ -->




<!-- ############< menu pour les donnees >############ -->
<?php   if($this->current_cm->current_class() == 'donnees'){   ?>

        <ul class="nav nav-tabs" id="myTab-1" role="tablist">

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Categorie') echo 'active';?>" id="profile-tab" href="<?=base_url('ihm/Categorie')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-box-open"></font> Categories</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Sous_categorie') echo 'active';?>" id="profile-tab" href="<?=base_url('ihm/Sous_categorie')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-shopping-basket"></font> Sous categories</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Produit_a_acheter') echo 'active';?>" id="profile-tab" href="<?=base_url('ihm/Produit_a_acheter')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-comments-dollar"></font> Produits à acheter</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Mode_Paiment') echo 'active';?>" id="profile-tab" href="<?=base_url('ihm/Mode_Paiment')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-money-check-alt"></font> Mode de paiement</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Mode_Unite_Mesure') echo 'active';?>" id="profile-tab" href="<?=base_url('ihm/Mode_Unite_Mesure')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-balance-scale"></font> Unite de mesure</a>
          </li>


      </ul> 
<?php } ?>
<!-- ############<! menu pour les donnees >############ -->




<!-- ############< menu pour le settings >############ -->
<?php   if($this->current_cm->current_class() == 'settings'){   ?>

        <ul class="nav nav-tabs" id="myTab-1" role="tablist">

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Settings') echo 'active';?>" id="profile-tab" href="<?=base_url('administration/Settings')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-cog"></font> Settings</a>
          </li>

          <li class="nav-item">
             <a class="nav-link <?php if($class == 'Utilisateurs') echo 'active';?>" id="profile-tab" href="<?=base_url('administration/Utilisateurs')?>" role="tab" aria-controls="profile" aria-selected="false"><font class="fa fa-users"></font> Utilisateurs</a>
          </li>
          
      </ul> 
<?php } ?>
<!-- ############<! menu pour settings >############ -->




        <div class="d-flex align-items-center">
           <div class="nav-item nav-icon change-mode">
              <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                 <div class="custom-switch-inner">
                    <p class="mb-0"> </p>
                    <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                    <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                       <span class="switch-icon-left"><i class="a-left"></i></span>
                       <span class="switch-icon-right"><i class="a-right"></i></span>
                    </label>
                 </div>
              </div>
           </div>
           <h4 class="current-time text-primary mr-md-4 mr-3">14:34:16</h4>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
              <i class="ri-menu-3-line"></i>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav align-items-center ml-auto navbar-list">

                 <li class="nav-item nav-icon search-content">
                    <a href="#" class="search-toggle box-square bg-danger-light" id="dropdownSearch" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                       <i class="ri-search-line"></i>
                    </a>
                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                       <form action="#" class="searchbox p-2">
                          <div class="form-group mb-0 position-relative">
                             <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                             <a href="#" class="search-link"><i class="ri-search-line"></i></a>
                          </div>
                       </form>
                    </div>
                 </li>
                 <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle box-square bg-success-light dropdown-toggle" id="dropdownMenuButton2"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="bg-primary count-mail" style="padding-left:-10px;margin-top:-25px;"></span>
                       <i class="fa fa-money-check-alt"></i>
                    </a>

                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                       <div class="card shadow-none m-0">
                          <div class="card-body p-0 ">
                             <div class="cust-title p-3">
                                <h6 class="mb-0">Historique paiement dettes</h6>
                             </div>
                             <div class="p-3">
                                <a href="#" class="iq-sub-card">
                                   <div class="media align-items-center">
                                      <div class="">
                                         <img class="avatar-40 rounded-small" src="<?= base_url()?>assets/images/user/01.jpg" alt="">
                                      </div>
                                      <div class="media-body ml-3">
                                         <h6 class="mb-0">Barry Emma Watson <small
                                               class="badge badge-success float-right">New</small></h6>
                                         <small class="float-left font-size-12">12:00 PM</small>
                                      </div>
                                   </div>
                                </a>
                                <a href="#" class="iq-sub-card">
                                   <div class="media align-items-center">
                                      <div class="">
                                         <img class="avatar-40 rounded-small" src="<?= base_url()?>assets/images/user/05.jpg" alt="">
                                      </div>
                                      <div class="media-body ml-3">
                                         <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                         <small class="float-left font-size-12">1 day ago</small>
                                      </div>
                                   </div>
                                </a>
                             </div>
                             <a class="btn btn-primary btn-block p-2" href="#" role="button" data-toggle="modal" data-target="vente">
                                View All
                             </a>
                          </div>
                       </div>
                    </div>
                 </li>
                 <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle box-square bg-warning-light dropdown-toggle" id="dropdownMenuButton"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="total_cart"></span>
                    </a>
                    <div class="iq-sub-dropdown dropdown-menu scroll" aria-labelledby="dropdownMenuButton">
                       <div class="card shadow-none m-0">
                          <div class="card-body p-0 ">
                             <div class="cust-title p-3">
                                <h5 class="mb-0">All Notifications</h5>
                             </div>
                             <!-- #######< detail cart >######## -->
                             <div class="p-3" id="cart_detail_header">
                             </div>
                             <!-- #######<! detail cart >######## -->
                               <a class="right-ic btn btn-primary btn-block position-relative p-2" href="<?=base_url('produits/Produits/vente')?>" role="button">
                                <div class="dd-icon"><i class="las la-arrow-right mr-0"></i></div>
                                View all
                             </a>
                          </div>
                       </div>
                    </div>
                 </li>                           
                 <li class="caption-content">
                    <a href="#" class="iq-user-toggle">
                       <img src="<?= base_url()?>assets/images/user/1.jpg" class="img-fluid rounded" alt="user">
                    </a>
                    <div class="iq-user-dropdown">
                       <div class="card">
                          <div class="card-header d-flex justify-content-between align-items-center mb-0">
                             <div class="header-title">
                                <h4 class="card-title mb-0">Profile</h4>
                             </div>
                             <div class="close-data text-right badge badge-primary cursor-pointer"><i class="ri-close-fill"></i>
                             </div>
                          </div>
                          <div class="data-scrollbar" data-scroll="4">
                             <div class="card-body">
                                <div class="profile-header">
                                   <div class="cover-container text-center">
                                      <img src="<?= base_url()?>assets/images/user/1.jpg" alt="profile-bg"
                                         class="rounded img-fluid avatar-80">
                                      <div class="profile-detail mt-3">
                                         <h3>Barry Tech</h3>
                                         <p class="mb-1">Web designer</p>
                                      </div>
                                      <a href="auth-sign-in.html" class="btn btn-primary">Sign Out</a>
                                   </div>
                                   <div class="profile-details my-4">
                                      <a href="http://iqonic.design/themes/prox/html/app/user-profile.html" class="iq-sub-card bg-primary-light rounded-small p-2">
                                         <div class="media align-items-center">
                                            <div class="rounded iq-card-icon-small">
                                               <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                               <h6 class="mb-0 ">My Profile</h6>
                                               <p class="mb-0 font-size-12">View personal profile details.</p>
                                            </div>
                                         </div>
                                      </a>
                                      <a href="http://iqonic.design/themes/prox/html/app/user-profile-edit.html" class="iq-sub-card bg-danger-light rounded-small p-2">
                                         <div class="media align-items-center">
                                            <div class="rounded iq-card-icon-small">
                                               <i class="ri-profile-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                               <h6 class="mb-0 ">Edit Profile</h6>
                                               <p class="mb-0 font-size-12">Modify your personal details.</p>
                                            </div>
                                         </div>
                                      </a>
                                      <a href="http://iqonic.design/themes/prox/html/app/user-account-setting.html" class="iq-sub-card bg-success-light rounded-small p-2">
                                         <div class="media align-items-center">
                                            <div class="rounded iq-card-icon-small">
                                               <i class="ri-account-box-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                               <h6 class="mb-0 ">Account settings</h6>
                                               <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                            </div>
                                         </div>
                                      </a>
                                      <a href="http://iqonic.design/themes/prox/html/app/user-privacy-setting.html" class="iq-sub-card bg-info-light rounded-small p-2">
                                         <div class="media align-items-center">
                                            <div class="rounded iq-card-icon-small">
                                               <i class="ri-lock-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                               <h6 class="mb-0 ">Privacy Settings</h6>
                                               <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                            </div>
                                         </div>
                                      </a>
                                   </div>
                                   <div class="personal-details">
                                      <h5 class="card-title mb-3 mt-3">Personal Details</h5>
                                      <div class="row align-items-center mb-2">
                                         <div class="col-sm-6">
                                            <h6>Birthday</h6>
                                         </div>
                                         <div class="col-sm-6">
                                            <p class="mb-0">3rd March</p>
                                         </div>
                                      </div>
                                      <div class="row align-items-center mb-2">
                                         <div class="col-sm-6">
                                            <h6>Address</h6>
                                         </div>
                                         <div class="col-sm-6">
                                            <p class="mb-0">Landon</p>
                                         </div>
                                      </div>
                                      <div class="row align-items-center mb-2">
                                         <div class="col-sm-6">
                                            <h6>Phone</h6>
                                         </div>
                                         <div class="col-sm-6">
                                            <p class="mb-0">(010)987 543 201</p>
                                         </div>
                                      </div>
                                      <div class="row align-items-center mb-2">
                                         <div class="col-sm-6">
                                            <h6>Email</h6>
                                         </div>
                                         <div class="col-sm-6">
                                            <p class="mb-0"><a href="http://iqonic.design/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="25674457575c65405d44485549400b464a48">[email&#160;protected]</a></p>
                                         </div>
                                      </div>
                                      <div class="row align-items-center mb-2">
                                         <div class="col-sm-6">
                                            <h6>Twitter</h6>
                                         </div>
                                         <div class="col-sm-6">
                                            <p class="mb-0">@Barry</p>
                                         </div>
                                      </div>
                                      <div class="row align-items-center mb-2">
                                         <div class="col-sm-6">
                                            <h6>Facebook</h6>
                                         </div>
                                         <div class="col-sm-6">
                                            <p class="mb-0">@Barry_Tech</p>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                                <div class="p-3"></div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </li>
              </ul>
           </div>
        </div>                  
     </nav>
  </div>
</div>




<script type="text/javascript">


  function view_all(){
    alert('ok')
  }
</script>