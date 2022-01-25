<?php

/**
 * 
 */
class Mode_Unite_Mesure extends CI_Controller
{
	function __construct()
	{ 
		parent::__Construct();
	}

	public function index()
	{
		$unitMesr=$this->Model->read('unite_mesure');
		
		  $data_data=array();
		   $t=0;
		foreach ($unitMesr as $value) {
			$fetch_data= array();
			$t=++$t;
			$fetch_data[]=$t;
			$fetch_data[]=$value['descr_unite_mesure'];
			

			$fetch_data[]='<div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('ihm/Mode_Unite_Mesure/select_one/').$value['id_unite_mesure'].'"><i class="ri-pencil-fill mr-2"></i>Modifier</a>
                                 
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_unite_mesure'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>
                              </div>
                           </div>
								<div class="modal fade" id="delete'.$value['id_unite_mesure'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Suppression d\'une unite de mesure</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['descr_unite_mesure'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('ihm/Mode_Unite_Mesure/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_unite_mesure'].'">
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
         $this->table->set_heading('#','UNITE DE MESURE','OPTION');
         $this->table->set_template($template);
         $data['title']='UNITE MESURE';
         $data['mesure']=$data_data;
         $this->load->view('Mode_Unite_Mesure_Liste',$data);
	} 
	
	public function add()
          {
          	$data['title']='ajouter unite de mesure';
          	$this->load->view('Mode_Unite_Mesure_Add_Vieu');
          }
      public function save()
      {
         $unitMesre=$this->input->post('unite_mesure');
         $data=array('descr_unite_mesure'=>$unitMesre);
         $this->Model->create('unite_mesure',$data);

         redirect(base_url('ihm/Mode_Unite_Mesure'));
      }
      function add_new(){

	  $this->form_validation->set_rules('
	  	','','required',['required'=>'Le champ est obligatoire']);

	if ($this->form_validation->run()==FALSE) {

	  	$this->add() ;
	  }else{
	  	$descr=$this->input->post('');

	  	$data=array('descr_unite_mesure'=>$descr
	  		      );
	  	$this->Model->create('Mode_Unite_Mesure',$data);
	  	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);

	  	redirect(base_url('ihm/Mode_Unite_Mesure/index'));
	  }    
	} 
       public function select_one($id)
       {
       	  $data['title']='change unite de mesure';
       	  $data['categ']=$this->Model->ReadOne('unite_mesure',array('id_unite_mesure'=>$id));
       	  $this->load->view('Mode_Unite_Mesure_Update_Vieu',$data);
       }
      public function update()
      {
      	$this->form_validation->set_rules('descr_unite_mesure','','required',['required'=>'le champ est obligatoire']);
	    $id=$this->input->post('id_unite_mesure');

      	if($this->form_validation->run()==FALSE)
      	{
      		$this->select_one($id);
      	}
			else{
					$descr=$this->input->post('descr_unite_mesure');

	     	$data=array('descr_unite_mesure'=>$descr
	  		      );
	    	$this->Model->update('unite_mesure',array('id_unite_mesure'=>$id),$data);
	  	   $data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
	     	$this->session->set_flashdata($data);

	     	redirect(base_url('ihm/Mode_Unite_Mesure/index'));
			 }
			   }

			public function delete()

		    {
			 	$id=$this->input->post('ID');
			 	$delete=$this->Model->delete('unite_mesure',array('id_unite_mesure'=>$id));
			 	$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
			 	$this->session->set_flashdata($data);
			 	redirect(base_url('ihm/Mode_Unite_Mesure'));
			 }
 
         
    }   