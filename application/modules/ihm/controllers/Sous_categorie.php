<?php 
	/**
	 * @author uyc.tic@gmail.com
	 */
	class Sous_categorie extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function add()
	    {
	    	$data['title']='Ajouter des sous categories';
	    	$data['souscat']=$this->Model->read('categorie');
		  	$this->load->view('Add_sous_categorie',$data);
		
	    }

		public function index()
	{
		
		$cate=$this->Model->readRequete('SELECT * FROM sous_categorie JOIN categorie On sous_categorie.id_categorie=categorie.id_categorie');

		$data_data=array();
		$u=0;
		foreach ($cate as $value) {

			$fetch_data=array();
			$u=++$u;
			$fetch_data[]=$u;
			$fetch_data[]=$value['descr_categorie'];
			$fetch_data[]=$value['descr_sous_categorie'];
			$fetch_data[]='<div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('ihm/sous_categorie/select_one/').$value['id_sous_categorie'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_sous_categorie'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                           </div>
                           <div class="modal fade" id="delete'.$value['id_sous_categorie'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							    <h4 class="modal-title ">Suppression d\'une sous categorie</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['descr_sous_categorie'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Sous_categorie/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_sous_categorie'].'">
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
        
      	$this->table->set_heading('#','DESCRIPTION CATEGORIE','DESCRIPTION SOUS CATEGORIE','OPTIONS');
       
      	$this->table->set_template($template);
      	 $data['title']='Liste des sous categories';
      	$data['cat']=$data_data;
      	
      	$this->load->view('List_sous_categorie',$data);
	}
function add_new(){

	  $this->form_validation->set_rules('id_categorie','','required',['required'=>'Le champ est obligatoire']);
	  $this->form_validation->set_rules('descr_sous_categorie','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$idcat=$this->input->post('id_categorie');
	  	$descrsou=$this->input->post('descr_sous_categorie');

	  	$data=array('id_categorie'=>$idcat,
	  				'descr_sous_categorie'=>$descrsou
	  		      );
	  	$this->Model->create('sous_categorie',$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Sous_categorie/index'));
	  }    
	}

	 public function select_one($id)
	 {

	 	$data['title']='Modifier une sous categorie';
	    $data['cat']=$this->Model->read('categorie');
	 	$data['categ']=$this->Model->readOne('sous_categorie',array('id_sous_categorie' =>$id ));
	 	$this->load->view('Sous_categorie_update_view',$data);

		
	 }
 function update(){

 	  $this->form_validation->set_rules('id_categorie','','required',['required'=>'Le champ est obligatoire']);
 	  $this->form_validation->set_rules('descr_sous_categorie','','required',['required'=>'Le champ est obligatoire']);

 	if ($this->form_validation->run()==FALSE) {

  	$this->add() ;
	  }else{
	  	$idcat=$this->input->post('id_categorie');
	  	$dsecsou=$this->input->post('descr_sous_categorie');
	  	$id=$this->input->post('id_sous_categorie');

	  	$data=array('id_categorie'=>$idcat,
	  				'descr_sous_categorie'=>$dsecsou
	  		      );
	  	$this->Model->update('sous_categorie',array('id_sous_categorie'=>$id),$data);

	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
	  	redirect(base_url('ihm/Sous_categorie/index'));
	  }    
 	}

 		public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('sous_categorie',array('id_sous_categorie'=>$id));	
		
		$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Sous_categorie/'));
	}
  }


