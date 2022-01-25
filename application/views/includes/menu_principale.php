  <?php if (empty($this->session->userdata('userid'))) {
           redirect(base_url());
       } ?>
  <div class="iq-sidebar">
            <div class="iq-sidebar-logo">
                <div class="iq-menu-bt-sidebar">
                    <i class="las la-bars wrapper-menu float-right"></i>
                </div>
            </div>
            <div class="p-pt">               
                <img src="<?= base_url()?>assets/images/logo/UYC.png" class="img-fluid avatar-60 rounded d-block mx-auto profile-img" alt="user">
                <div class="profile-detail mt-3 text-center">
                    <h4>UYC</h4>
                    <p class="text-primary mb-0">United Youth Company</p>
                </div>
                <div class="seprator"></div>
            </div> 
                               
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li class="<?php if($this->current_cm->current_class()=='dashboard') echo 'active';?>">
                        <a href="<?=base_url('rapport/Dashboard')?>" class="">
                            <i class="fa fa-book"></i>
                            <span>Dashboard</span>
                        </a>                        
                        </li>
                        <li class="<?php if($this->current_cm->current_class()=='stock') echo 'active';?>">
                        <a href="<?=base_url('produits/Produits')?>" class="">
                          <i class="fa fa-warehouse"></i>
                          <span>Stock</span>
                        </a>                        
                        </li>
                        <li class="<?php if($this->current_cm->current_class()=='donnees') echo 'active';?>">
                        <a href="<?=base_url('ihm/Categorie')?>" class="">
                          <i class="fa fa-database"></i>
                          <span>Données</span>
                        </a>                        
                        </li>
                        <li class="<?php if($this->current_cm->current_class()=='Reporting') echo 'active';?>">
                        <a href="<?=base_url('rapport/Rapport_produits_dormants')?>" class="">
                            <i class="fa fa-database"></i>
                            <span>Reporting</span>
                        </a>                        
                        </li>
                        <li class="<?php if($this->current_cm->current_class()=='settings') echo 'active';?>">
                        <a href="<?=base_url('administration/Settings')?>" class="">
                            <i class="fa fa-cog"></i>
                            <span>Settings</span>                        
                        </a>                       
                        </li>
                    </ul>
                </nav>
                <div class="seprator"></div>
                <div class="sidebar-bottom-menu">
                    <nav class="iq-sidebar-menu">
                        <div class="text-center mt-3">
                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fa fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </nav>
                </div>
                <div class="p-3"></div>
            
            </div>
        </div>



                





