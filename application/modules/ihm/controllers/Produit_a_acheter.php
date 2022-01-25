<?php 
	/**
	 * @author uyc.tic@gmail.com
	 */
	class Produit_a_acheter extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function add()
	    {
	    	$data['title']='Ajouter un produit a acheter';
	    	$data['unite']=$this->Model->read('unite_mesure');
		  	$this->load->view('Add_produit_a_acheter',$data);
		
	    }

	public function index()
	{

		$pdt=$this->Model->readRequete('SELECT * FROM produit_a_acheter JOIN unite_mesure On produit_a_acheter.id_unite_mesure=unite_mesure.id_unite_mesure');
		
		$produit=$this->Model->read('produit_a_acheter');
		$data_data=array();
		$u=0;
		foreach ($pdt as $value) {

			$fetch_data=array();
			$u=++$u;
			$fetch_data[]=$u;
			$fetch_data[]='<center><a href="'.base_url('upload/produits_image/').$value['image'].'" target="_blank"><img src="'.base_url('upload/produits_image/').$value['image'].'" alt="photo" style="width:40px;height:40px;"></center></a>';
			$fetch_data[]=$value['descr_unite_mesure'];
			$fetch_data[]=$value['description'];
			$fetch_data[]='<div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                  <a class="dropdown-item" href="'.base_url('ihm/Produit_a_acheter/select_one/').$value['id_produit'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_produit'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                           </div>
								<div class="modal fade" id="delete'.$value['id_produit'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Suppression d\'un produit a acheter</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['description'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Produit_a_acheter/delete').'" method="post">
							      	<div class="modal-footer">
							      	<input type="hidden" name="ID" value="'.$value['id_produit'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
                                 ';
			//$fetch_data[]=$options;
			$data_data[]=$fetch_data;

		}

		$template = array(
          'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed">',
          'table_close' => '</table>'
      	);
        
      	$this->table->set_heading('#','IMAGE','UNITE DE MESURE','DESCRIPTION','OPTIONS');
       
      	$this->table->set_template($template);
      	 $data['title']='Liste des produits a acheter';
      	$data['Produit_a_acheter']=$data_data;
      	$this->load->view('List_produit_a_acheter',$data);
	}

	
function add_new(){

	  $this->form_validation->set_rules('description','','required',['required'=>'Le champ est obligatoire']);
	  $this->form_validation->set_rules('id_unite_mesure','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$idunit=$this->input->post('id_unite_mesure');
	  	$descr=$this->input->post('description');
	  	$image=$this->upload_file($_FILES['image']['tmp_name'],$_FILES['image']['name']);
	  	$data=array('description'=>$descr,
	  				'image'=>$image,
	  				'id_unite_mesure'=>$idunit);
  		

	  	$this->Model->create('produit_a_acheter',$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';


		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Produit_a_acheter/index'));
	  }    
	}

	public function select_one($id)
	{

		$data['title']='Modifier un produit a acheter';
		$data['pdts']=$this->Model->read('unite_mesure');
		$data['pdtach']=$this->Model->readOne('produit_a_acheter',array('id_produit' =>$id ));
		$this->load->view('Update_produit_a_acheter',$data);

		
	}
function update(){

	  $this->form_validation->set_rules('id_unite_mesure','','required',['required'=>'Le champ est obligatoire']);
	  $this->form_validation->set_rules('description','','required',['required'=>'Le champ est obligatoire']);


	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$idpdt=$this->input->post('id_unite_mesure');
	  	$descr=$this->input->post('description');
	  	$id=$this->input->post('id_produit');

	  	$data=array('description'=>$descr,
	  				'id_unite_mesure'=>$idpdt
	  		      );
	  	$this->Model->update('produit_a_acheter',array('id_produit'=>$id),$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Produit_a_acheter/index'));
	  }    
	}


	public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('produit_a_acheter',array('id_produit'=>$id));	
		
		$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Produit_a_acheter/'));
	}

	public function upload_file($nom_file,$nom_champ)
{
      $ref_folder =FCPATH.'upload/produits_image';
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
  }


