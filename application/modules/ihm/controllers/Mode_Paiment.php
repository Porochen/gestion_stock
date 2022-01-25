<?php

/**
 * 
 */
class Mode_Paiment extends CI_Controller
{
	
	function __construct()
	{
	  parent::__construct();
	}
	public function index()
	{
		$paiment=$this->Model->read('mode_payement');
		
		  $data_data=array();
		   $t=0;
		foreach ($paiment as $value) {
			$fetch_data= array();
			$t=++$t;
			$fetch_data[]=$t;
			$fetch_data[]=$value['payement_desc'];
			

			$fetch_data[]='<div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('ihm/Mode_Paiment/select_one/').$value['id_mode_payement'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                 
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_mode_payement'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                           </div>
								<div class="modal fade" id="delete'.$value['id_mode_payement'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Suppression d\'une mode de payement</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['payement_desc'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Mode_Paiment/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_mode_payement'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->';
					$data_data[]=$fetch_data;

		}

      $template = array('table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condansed">' ,'table_close'=>'</table>' );
         $this->table->set_heading('#','MODE DE PAYEMENT','OPTION');
         $this->table->set_template($template);
         $data['title']='MODE PAYEMENT';
         $data['categ']=$data_data;
         $this->load->view('Mode_Payement_List_Vieu',$data);
	} 
	public function add()
	    {
	    
	    	$data['title']='Ajouter un mode de paiment';
		  	$this->load->view('Mode_Payement_Add_Vieu',$data);
		
	    }
	    public function save()
	    {
	    	$modepaiment=$this->input->post('mode_payement');
	    	$data=array('payement_desc'=>$modepaiment);
        	$this->Model->create('mode_payement',$data);

          redirect(base_url('index.php/ihm/Mode_Paiment'));
		}  

function add_new(){

	  $this->form_validation->set_rules('
	  	','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$descr=$this->input->post('payement_desc');

	  	$data=array('payement_desc'=>$descr
	  		      );
	  	$this->Model->create('Mode_Paiment',$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Mode_Paiment/index'));
	  }    
	} 
		public function select_one($id)
		{
			$data['title']='modifier le mode de payement';
			$data['categ']=$this->Model->readOne('mode_payement',array('id_mode_payement'=>$id));
			$this->load->view('Mode_Payement_Update_Vieu',$data);
		}
		      function update()
		{
			$this->form_validation->set_rules('payement_desc','','required',['required'=>'le champ est obligatoire']);
			$id=$this->input->post('id_mode_payement');
			$descr=$this->input->post('payement_desc');
			print_r($descr);
			//exit();

			if ($this->form_validation->run()==FALSE)
			   {
				  $this->select_one($id);
			    }

			else{
			
	     	
	     	$data=array('payement_desc'=>$descr);
	    	$this->Model->update('Mode_Payement',array('id_mode_payement'=>$id),$data);
	  	   $data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
	     	$this->session->set_flashdata($data);

	     	redirect(base_url('index.php/ihm/Mode_Paiment/index'));
			 }
         }


			public function delete()
			{
				$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('mode_payement',array('id_mode_payement'=>$id));	
		
		$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('ihm/Mode_Paiment'));
			}
 }    
