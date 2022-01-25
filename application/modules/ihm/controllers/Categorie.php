<?php 
	/**
	 * @author uyc.tic@gmail.com
	 */
	class Categorie extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function add()
	    {
	    	$data['title']='Ajouter une categorie';
		  	$this->load->view('categorie_add_view',$data);
		
	    }

	public function index()
	{
		
		$cate=$this->Model->read('categorie');

		$data_data=array();
		$u=0;
		foreach ($cate as $value) {

			$fetch_data=array();
			$u=++$u;
			$fetch_data[]=$u;
			$fetch_data[]=$value['descr_categorie'];

			$fetch_data[]='<div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('ihm/Categorie/select_one/').$value['id_categorie'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                 
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_categorie'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                           </div>
								<div class="modal fade" id="delete'.$value['id_categorie'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Suppression d\'une categorie</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['descr_categorie'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Categorie/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_categorie'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->';
			//$fetch_data[]=$options;
			$data_data[]=$fetch_data;

		}

		$template = array(
          'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed">',
          'table_close' => '</table>'
      	);
        
      	$this->table->set_heading('#','DESCRIPTION','OPTIONS');
       
      	$this->table->set_template($template);
      	 $data['title']='Liste des categories';
      	$data['cat']=$data_data;
      	
      	$this->load->view('List_categorie',$data);
	}

	
function add_new(){

	  $this->form_validation->set_rules('descr_categorie','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$descr=$this->input->post('descr_categorie');

	  	$data=array('descr_categorie'=>$descr
	  		      );
	  	$this->Model->create('categorie',$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Categorie/index'));
	  }    
	}

	public function select_one($id)
	{

		$data['title']='Modifier une categorie';
		$data['categ']=$this->Model->readOne('categorie',array('id_categorie' =>$id ));
		$this->load->view('categorie_update_view',$data);

		
	}
function update(){

	  $this->form_validation->set_rules('descr_categorie','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$descr=$this->input->post('descr_categorie');
	  	$id=$this->input->post('id_categorie');

	  	$data=array('descr_categorie'=>$descr
	  		      );
	  	$this->Model->update('categorie',array('id_categorie'=>$id),$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Categorie/index'));
	  }    
	}


	public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('categorie',array('id_categorie'=>$id));	
		
		$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Categorie/'));
	}
  }


