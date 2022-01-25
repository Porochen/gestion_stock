<?php 
	/**
	 * @author uyc.tic@gmail.com
	 */
	class Fournisseur extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}
		function Add()
		{
			$data['title']='Ajouter un Fournisseur';
			$data['prov']=$this->Model->read('provinces');
			$data['province']=$this->Model->read('provinces');
		    $data['commune']=$this->Model->read('communes');
			$data['zone']=$this->Model->read('zones');
			$data['colline']=$this->Model->read('collines');
			$this->load->view('Add_fournisseur',$data);
		}

		public function index()
	{
		
		$fnr=$this->Model->readRequete('Select *FROM fournisseur inner join provinces on fournisseur.province_id =provinces.province_id inner join communes on fournisseur.commune_id=communes.commune_id inner join zones on fournisseur.zone_id=zones.zone_id inner join collines on fournisseur.colline_id=collines.colline_id ');

		$data_data=array();
		$u=0;
		foreach ($fnr as $value) {

			$fetch_data=array();
			$u=++$u;
			$fetch_data[]=$u;
			$fetch_data[]=$value['nom_fournisseur'];
			$fetch_data[]=$value['prenom_fournisseur'];
			$fetch_data[]=$value['tel_client'];
			$fetch_data[]=$value['is_whatsapp'];
			$fetch_data[]=$value['email_fournisseur'];
			$fetch_data[]=$value['adresse_fournisseur'];
			$fetch_data[]=$value['province_name'];
			$fetch_data[]=$value['commune_name'];
			$fetch_data[]=$value['zone_name'];
			$fetch_data[]=$value['colline_name'];
			$fetch_data[]=' <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('ihm/Fournisseur/select_one/').$value['id_fournisseur'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_fournisseur'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                              </div>
                           <div class="modal fade" id="delete'.$value['id_fournisseur'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							    <h4 class="modal-title ">Suppression d\'un fournisseur</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['nom_fournisseur'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Fournisseur/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_fournisseur'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->';

			$data_data[]=$fetch_data;

		}

		$template = array(
          'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed">',
          'table_close' => '</table>'
      	);
        
      	$this->table->set_heading('#','NOM','PRENOM','TELEPHONE','WHATSAPP','E_MAIL','ADDRESSE','PROVINCE','COMMUNE','ZONE','COLLINE','OPTIONS');
       
      	$this->table->set_template($template);
      	 $data['title']='Liste des fournisseurs';
      	$data['fnr']=$data_data;
      	
      	$this->load->view('List_fournisseur',$data);
	}


	function add_new(){
	$this->form_validation->set_rules('nom_fournisseur','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('prenom_fournisseur','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('tel_client','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('is_whatsapp','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('email_fournisseur','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('adresse_fournisseur','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('province_id','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('commune_id','','required',['required'=>'Le champ est obligatoire']);
	 $this->form_validation->set_rules('zone_id','','required',['required'=>'Le champ est obligatoire']);
     $this->form_validation->set_rules('colline_id','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;

	  }else{

	  	$nm=$this->input->post('nom_fournisseur');
	  	$pnm=$this->input->post('prenom_fournisseur');
	  	$tel=$this->input->post('tel_client');
	  	$whts=$this->input->post('is_whatsapp');
	  	$email=$this->input->post('email_fournisseur');
	  	$adress=$this->input->post('adresse_fournisseur');
	  	$idpr=$this->input->post('province_id');
	  	$cmm=$this->input->post('commune_id');
	  	$zne=$this->input->post('zone_id');
	  	$cln=$this->input->post('colline_id');
	  	
	  	

	  	$data=array('province_id'=>$idpr,
	  		        'colline_id'=>$cln,
	  				'zone_id'=>$zne,
	  				'commune_id'=>$cmm,
	  				'nom_fournisseur'=>$nm,
	  				'prenom_fournisseur'=>$pnm,
	  				'tel_client'=>$tel,
	  				'is_whatsapp'=>$whts,
	  				'email_fournisseur'=>$email,
	  				'adresse_fournisseur'=>$adress
	  				);
	  	$this->Model->create('fournisseur',$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Fournisseur/index'));
	  }    
	}

	 public function select_one($id)
	 {

	 	$data['title']='Modifier un fournisseur';
	    $data['province']=$this->Model->read('provinces');
		$data['commune']=$this->Model->read('communes');
		$data['zone']=$this->Model->read('zones');
		$data['colline']=$this->Model->read('collines');
	 	$data['fnr']=$this->Model->readOne('fournisseur',array('id_fournisseur' =>$id ));
	 	$this->load->view('fournisseur_update_view',$data);
	 }
 function update($id_fournisseur=0){

 	  $this->form_validation->set_rules('province_id','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('colline_id','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('zone_id','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('commune_id','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('nom_fournisseur','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('prenom_fournisseur','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('tel_client','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('is_whatsapp','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('email_fournisseur','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('adresse_fournisseur','','required',['required'=>'Le champ est obligatoire']);


 	if ($this->form_validation->run()==FALSE) {

  	$this->select_one($id_fournisseur);
	  }else{
	  	$idpr=$this->input->post('province_id');
	  	$coll=$this->input->post('colline_id');
	  	$zon=$this->input->post('zone_id');
	  	$com=$this->input->post('commune_id');
	  	$nmfr=$this->input->post('nom_fournisseur');
	  	$pnmfr=$this->input->post('prenom_fournisseur');
	  	$tlcl=$this->input->post('tel_client');
	  	$whts=$this->input->post('is_whatsapp');
	  	$eml=$this->input->post('email_fournisseur');
	  	$adrfru=$this->input->post('adresse_fournisseur');
	  	// $idfr=$this->input->post('id_fournisseur');

	  	$data=array('province_id'=>$idpr,
	  				'nom_fournisseur'=>$nmfr,
	  				'prenom_fournisseur'=>$pnmfr,
	  				'tel_client'=>$tlcl,
	  				'is_whatsapp'=>$whts,
	  				'email_fournisseur'=>$eml,
	  				'adresse_fournisseur'=>$adrfru,
	  			 	 'colline_id'=>$coll,
	  			 	 'zone_id'=>$zon,
	  			 	 'commune_id'	=>$com);
	  	$this->Model->update('fournisseur',array('id_fournisseur'=>$id_fournisseur),$data);

	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
	  	redirect(base_url('ihm/Fournisseur/index'));
	  }    
 	}
 		public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('fournisseur',array('id_fournisseur'=>$id));	
		
		$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Fournisseur/'));
	}

	public function get_commune()
	{
		$province_id=$this->input->post('province_id');
    	$communes=$this->Model->read('communes',['province_id'=>$province_id]);
		echo '<option value="">Sélectionner</option>';
      foreach ($communes as $commune) {  
		echo '    <option value="'.$commune['commune_id'].'">
            '.$commune['commune_name'].'
          </option> ';
      }
	}
	public function get_zone()
	{
		$commune_id=$this->input->post('commune_id');
    	$zones=$this->Model->read('zones',['commune_id'=>$commune_id]);
		echo '<option value="">Sélectionner</option>';
      foreach ($zones as $zone) {  
		echo '    <option value="'.$zone['zone_id'].'">
            '.$zone['zone_name'].'
          </option> ';
      }
	}
	public function get_colline()
	{
		$zone_id=$this->input->post('zone_id');
    	$zones=$this->Model->read('collines',['zone_id'=>$zone_id]);
		echo '<option value="">Sélectionner</option>';
      foreach ($zones as $zone) {  
		echo '    <option value="'.$zone['colline_id'].'">
            '.$zone['colline_name'].'
          </option> ';
      }
	}

  }


