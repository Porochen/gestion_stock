<?php
/**
 *@author uyc.tic@gmail.com
 * @author JEAN DE DIEU
 */
class Utilisateurs extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$users=$this->Model->read('admin_user');

		$data_data=array();
		foreach ($users as $value) {

			$fetch_data=array();

			$fetch_data[]=$value['username'];
			$fetch_data[]=$value['telephone'];
			$fetch_data[]=$value['adresse'];
			$fetch_data[]=$value['statut']==1 ? 'Activé' : 'Desactivé';
			$fetch_data[]=$value['date_creation'];
			$options=' <div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn btn-outline-primary" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="'.base_url('administration/Utilisateurs/select_one/').$value['id_admin_user'].'"><i class="ri-mark-pen-fill mr-2"></i>Modifier</a>
                                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete'.$value['id_admin_user'].'"><i class="ri-delete-bin-6-fill mr-2"></i><font class="text-danger">Supprimer</font></a>';

			            if ($value['statut']==1) {
							$options.='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#statut'.$value['id_admin_user'].'"><i class="ri-user-unfollow-fill mr-2"></i>Desactiver</a>';
							$titre="Voulez-vous vraiment desactiver ";	
							$stat=0;
				    	
						}else{

							$options.='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#statut'.$value['id_admin_user'].'"><i class="ri-user-follow-fill mr-2"></i>Activer</a>';;
							$titre="Voulez-vous vraiment activer ";
							$stat=1;					   
						}
                          
                          $options.='</div>
                           </div>
								<div class="modal fade" id="delete'.$value['id_admin_user'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Suppression d\'un Utilisateur</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>Voulez-vous vraiment Supprimer : <b style="color:green">'.$value['username'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('administration/Utilisateurs/delete').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_admin_user'].'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->';

				$options.='<div class="modal fade" id="statut'.$value['id_admin_user'].'">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							      <h4 class="modal-title ">Changement de statut</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							      </div>
							      <div class="modal-body">
							        <p>'.$titre.' : <b style="color:green">'.$value['username'].'</b> ?</p>
							      </div>
							      <form action="'.base_url('administration/Utilisateurs/statut').'" method="post">
							      	<div class="modal-footer">
							      		<input type="hidden" name="ID" value="'.$value['id_admin_user'].'">
							      		<input type="hidden" name="STATUT" value="'.$stat.'">
								        <button type="button" class="btn btn-outline-default pull-left" data-dismiss="modal">Annuler</button>
								        <input type="submit" name="submit" class="btn btn-outline-primary" value="Changer">
							      </div>
							      </form>
							      
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

								';

			$fetch_data[]=$options;
			$data_data[]=$fetch_data;

		}

		$template = array(
          'table_open' => '<table id="mytable" class="table table-bordered table-stripped table-hover table-condensed">',
          'table_close' => '</table>'
      	);
        
      	$this->table->set_heading('UTILISATEUR','TELEPHONE','ADRESSE','STATUT','DATE CREATION','OPTIONS');
       
      	$this->table->set_template($template);
      	$data['title']='Liste des utilisateurs';
      	$data['users']=$data_data;
      	
      	$this->load->view('User_List_View',$data);
	}


	public function before_validation()
	{
		$this->form_validation->set_rules('username','','trim|required',array('required' =>'Le champ est obligatoire' ));
		$this->form_validation->set_rules('phone','','trim|required',array('required' =>'Le champ est obligatoire' ));
		$this->form_validation->set_rules('province_id','','trim|required',array('required' =>'Le champ est obligatoire' ));
		$this->form_validation->set_rules('commune_id','','trim|required',array('required' =>'Le champ est obligatoire' ));
		$this->form_validation->set_rules('zone_id','','trim|required',array('required' =>'Le champ est obligatoire' ));
		$this->form_validation->set_rules('colline_id','','trim|required',array('required' =>'Le champ est obligatoire' ));
		$this->form_validation->set_rules('adresse','','trim|required',array('required' =>'Le champ est obligatoire' ));


	}

	public function add()
	{
		$data['title']='Ajouter un utilisateur';
		$data['province']=$this->Model->read('provinces');
		$data['commune']=$this->Model->read('communes');
		$data['zone']=$this->Model->read('zones');
		$data['colline']=$this->Model->read('collines');
		$this->load->view('User_Add_View',$data);
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

	public function save()
	{

		$this->before_validation();
		if ($this->form_validation->run()==FALSE) {
			$this->add();
		}else{
		$username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $province_id = $this->input->post('province_id');
        $commune_id = $this->input->post('commune_id');
        $zone_id = $this->input->post('zone_id');
        $colline_id = $this->input->post('colline_id');
        $adresse = $this->input->post('adresse');

        $data = array('username' =>$username ,'password' =>md5('123456'),'telephone' =>$phone,'province_id' =>$province_id,'commune_id' =>$commune_id,'zone_id' =>$zone_id,'colline_id' =>$zone_id,'adresse' =>$adresse, );
        $this->Model->create('admin_user',$data);
        $data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('administration/Utilisateurs/'));
		}

	}

	public function select_one($id)
	{
		$data['title']='Modifier un utilisateur';
		
		$data['province']=$this->Model->read('provinces');
		$data['commune']=$this->Model->read('communes');
		$data['zone']=$this->Model->read('zones');
		$data['colline']=$this->Model->read('collines');
		$data['user']=$this->Model->readOne('admin_user',array('id_admin_user'=>$id));
		$this->load->view('User_Update_View',$data);
	}

	public function update()
	{
		$this->before_validation();
		if ($this->form_validation->run()==FALSE) {
			$this->select_one();
		}else{
		$id = $this->input->post('id');
		$username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $province_id = $this->input->post('province_id');
        $commune_id = $this->input->post('commune_id');
        $zone_id = $this->input->post('zone_id');
        $colline_id = $this->input->post('colline_id');
        $adresse = $this->input->post('adresse');

        $data = array('username' =>$username ,'telephone' =>$phone,'province_id' =>$province_id,'commune_id' =>$commune_id,'zone_id' =>$zone_id,'colline_id' =>$zone_id,'adresse' =>$adresse, );
        $this->Model->update('admin_user',array('id_admin_user'=>$id),$data);
        $data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('administration/Utilisateurs/'));
		}
	}
	public function delete()
	{
		$id=$this->input->post('ID');
		
		$delete=$this->Model->delete('admin_user',array('id_admin_user'=>$id));	
		
		$data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('administration/Utilisateurs/'));
	}


	public function statut()
	{
		$ID = $this->input->post('ID');
		$STATUT = $this->input->post('STATUT');
		if ($STATUT==1) {

			$data = array('statut' =>$STATUT );
       
        	$users=$this->Model->update('admin_user',array('id_admin_user'=>$ID),$data);
		}else{
			$data = array('statut' =>$STATUT );
       
        	$users=$this->Model->update('admin_user',array('id_admin_user'=>$ID),$data);
		}

        
        $data['sms']='<div class="alert alert-success text-center" id ="sms">Opération faite avec succes.</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('administration/Utilisateurs/'));
	}
}