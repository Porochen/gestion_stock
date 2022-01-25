<?php

class MY_Controller extends CI_Controller {

   public function __construct()
   {
   	parent::__construct();
   }

   public function has_autorisation()
   {
      if (empty($this->session->userdata('userid'))) {
           redirect(base_url());
       }
   }

}
