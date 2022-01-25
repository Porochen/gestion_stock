<?php

/**
 * 
 */
class Settings extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$settings['logo']=$this->Model->getValueSettings('logo') ;
    $settings['name_apk']=$this->Model->getValueSettings('name_apk') ;
    $settings['theme_apk']=$this->Model->getValueSettings('theme_apk') ;
    $settings['name_imprimante']=$this->Model->getValueSettings('name_imprimante') ;
    $settings['name_societe']=$this->Model->getValueSettings('name_societe') ;
    $settings['localite']=$this->Model->getValueSettings('localite') ;
    $settings['phone']=$this->Model->getValueSettings('phone') ;
    $settings['email']=$this->Model->getValueSettings('email') ;
    $settings['title']="Les settings";
		$this->load->view('Settings_View',$settings);
	}
	public function upload_file($nom_file,$nom_champ)
{
      $ref_folder =FCPATH.'upload/settings_images';
      $code=date("YmdHis").uniqid();
      $fichier=basename($code);
      $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
      // $valid_ext = array('gif','jpg','png','jpeg','JPG','PNG','JPEG');

      if(!is_dir($ref_folder)) //create the folder if it does not already exists   
      {
          mkdir($ref_folder,0777,TRUE);
                                                     
      } 
      move_uploaded_file($nom_file, "$ref_folder/$fichier.$file_extension");
      $image_name=$fichier.".".$file_extension;
      return $image_name;
}

	public function update_logo()
	{
		$logo=$this->upload_file($_FILES['sitelogo']['tmp_name'],$_FILES['sitelogo']['name']);
		$this->Model->setValueStore('logo',$logo);

		redirect(base_url('administration/Settings')) ;
	}

	public function update_nameapk()
	{
		$name_apk=$this->input->post('name_apk');
  	
    $this->Model->setValueStore('navi_text',$name_apk);
		redirect(base_url('administration/Settings')) ;

	}

	public function update_themeapk()
	{
		$theme_apk=$this->input->post('theme_apk');
  	
    $this->Model->setValueStore('theme_apk',$theme_apk);
		redirect(base_url('administration/Settings')) ;

	}

	public function update_imprimante()
	{
		$name_imprimante=$this->input->post('name_imprimante');
  	
    $this->Model->setValueStore('name_imprimante',$name_imprimante);
		redirect(base_url('administration/Settings')) ;

	}

	public function update_proprietaire()
	{
		$name_societe=$this->input->post('name_societe');
		$localite=$this->input->post('localite');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
    $this->Model->setValueStore('name_societe',$name_societe);
    $this->Model->setValueStore('localite',$localite);
    $this->Model->setValueStore('phone',$phone);
    $this->Model->setValueStore('email',$email);
		redirect(base_url('administration/Settings')) ;

	}

}