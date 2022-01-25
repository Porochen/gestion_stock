<?php 
	/**
	 * @author uyc.tic@gmail.com
	 * niyodon
	 */
	class Produit_Vendu extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index()
	    {
	      $data['produits']=$this->Model->readRequete('SELECT * FROM produits WHERE 1 ORDER BY nom_produit');
	      $data['modePayement']=$this->Model->readRequete('SELECT * FROM mode_payement WHERE 1 ORDER BY payement_desc');
	      
		  $this->load->view('produit_vendu/Produit_Vendu_New_View',$data);
	    }

	    function listing($key_search=''){
         $data['title']="Liste des Produit_Vendu";
         
         $critere = !empty($key_search) ? '  and (nom_produit LIKE "%'.$key_search.'%" OR prix_unitaire_achat LIKE "%'.$key_search.'%" OR prix_unitaire_vente LIKE "%'.$key_search.'%" OR quantite LIKE "%'.$key_search.'%" OR tel_client LIKE "%'.$key_search.'%" OR descr_categorie LIKE "%'.$key_search.'%" OR descr_sous_categorie LIKE "%'.$key_search.'%" OR nom_fournisseur LIKE "%'.$key_search.'%" OR prenom_fournisseur LIKE "%'.$key_search.'%")' : '';

         $data['produit_info']=$this->Model->readRequete("SELECT p.*,c.descr_categorie,sc.descr_sous_categorie,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom,f.is_whatsapp,f.tel_client,f.email_fournisseur FROM Produit_Vendu p LEFT JOIN categorie c ON c.id_categorie=p.id_categorie LEFT JOIN sous_categorie_produit sc ON sc.id_sous_categorie=p.id_sous_categorie LEFT JOIN fournisseur f ON f.id_fournisseur=p.id_fournisseur WHERE 1 ".$critere." ORDER BY p.date_insertion DESC") ;

	     $produit_info=$this->load->view('Produit_Vendu/Produit_List_Search_View',$data,TRUE);
	     echo json_encode($produit_info);
	    }

	    function get_sous_categories(){
	      $id_categorie=$this->input->post('id_categorie');
	      $sous_categorie=$this->Model->readRequete('SELECT * FROM sous_categorie_produit WHERE id_categorie ='.$id_categorie.' ORDER BY descr_sous_categorie');
	      $opt='';
	  $opt.='<option value="">Séléctionner</option>';
        foreach ($sous_categorie as $value) { 
           if ($value['id_sous_categorie']==set_value('id_sous_categorie')) {

      $opt.='<option selected="" value="'.$value['id_sous_categorie'].'">'.
               $value['descr_sous_categorie']
              .'</option>';
          } else {  
      $opt.='<option value="'.$value['id_sous_categorie'].'">'.
               $value['descr_sous_categorie']
             .'</option>';
            } 
           } 

          echo $opt;

	    }


	    function add_new_view(){
          $data['categories']=$this->Model->readRequete('SELECT * FROM categorie WHERE 1 ORDER BY descr_categorie');
          $data['fournisseur']=$this->Model->readRequete("SELECT f.id_fournisseur,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom FROM fournisseur f WHERE 1 ORDER BY f.nom_fournisseur");

		  $this->load->view('Produit_Vendu/Produit_Add_View',$data);
	    }


	    function add_new(){
	      $this->form_validation->set_rules('id_categorie','','required',['required'=>'champ obligatoire']);
	      $this->form_validation->set_rules('id_sous_categorie','','required',['required'=>'champ obligatoire']);
	      $this->form_validation->set_rules('nom_produit','','required',['required'=>'champ obligatoire']);
	      $this->form_validation->set_rules('quantite','','required',['required'=>'champ obligatoire']);
	      $this->form_validation->set_rules('prix_unitaire_vente','','required',['required'=>'champ obligatoire']);
	      $this->form_validation->set_rules('prix_unitaire_achat','','required',['required'=>'champ obligatoire']);

	      if ($this->form_validation->run()==FALSE) {
	      	$this->add_new_view() ;
	      } else {
	      	$id_categorie=$this->input->post('id_categorie');
	      	$id_sous_categorie=$this->input->post('id_sous_categorie');
	      	$nom_produit=$this->input->post('nom_produit');
	      	$quantite=$this->input->post('quantite');
	      	$prix_unitaire_vente=$this->input->post('prix_unitaire_vente');
	      	$prix_unitaire_achat=$this->input->post('prix_unitaire_achat');
	      	$id_fournisseur=$this->input->post('id_fournisseur');
            
            $image=null;

	      	if (!empty($_FILES['image']['name'])) {
	      		$image=$this->upload_document($_FILES['image']['tmp_name'],$_FILES['image']['name']);
	      	}

	      	$data=array('id_categorie'=>$id_categorie,
	      		        'id_sous_categorie'=>$id_sous_categorie,
	      		        'nom_produit'=>$nom_produit,
	      		        'quantite'=>$quantite,
	      		        'quantite_restante'=>$quantite,
	      		        'code_produit'=>1000,
	      		        'image'=>$image,
	      		        'id_fournisseur'=>$id_fournisseur,
	      		        'prix_unitaire_vente'=>$prix_unitaire_vente,
	      		        'prix_unitaire_achat'=>$prix_unitaire_achat
	      		      );
	      	$this->Model->create('Produit_Vendu',$data);
	      }
	      
	    }


	  function delete($id){

       $this->Model->delete('Produit_Vendu',array('id_produit'=>$id));
   	   $sms['sms']='<div class="alert alert-success text-center col-md-12 col-md-offset-2" id="message"><strong> Oup! </strong> 
                         produit supprimé avec succèss  ! .
                   </div>';
        $this->session->set_flashdata($sms) ;
   	    redirect('Produit_Vendu/Produit_Vendu');
   	}

   	function update_view($id){
   	  $data['title']='Modification';
   	  $data['categories']=$this->Model->readRequete('SELECT * FROM categorie WHERE 1 ORDER BY descr_categorie');
      $data['fournisseur']=$this->Model->readRequete("SELECT f.id_fournisseur,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom FROM fournisseur f WHERE 1 ORDER BY f.nom_fournisseur");

   	  $data['product_info']=$this->Model->readRequeteOne('SELECT p.*,sc.descr_sous_categorie FROM Produit_Vendu p JOIN sous_categorie_produit sc ON sc.id_sous_categorie=p.id_sous_categorie WHERE p.id_produit='.$id.'');
   	  $this->load->view('Produit_Vendu/Produit_Update_View',$data);
   	}

   	function update($id){

        $id_categorie=$this->input->post('id_categorie');
	  	$id_sous_categorie=$this->input->post('id_sous_categorie');
	  	$nom_produit=$this->input->post('nom_produit');
	  	$quantite=$this->input->post('quantite');
	  	$prix_unitaire_vente=$this->input->post('prix_unitaire_vente');
	  	$prix_unitaire_achat=$this->input->post('prix_unitaire_achat');
	  	$id_fournisseur=$this->input->post('id_fournisseur');
	    
	    $image=null;

	  	if (!empty($_FILES['image']['name'])) {
	  		$image=$this->upload_document($_FILES['image']['tmp_name'],$_FILES['image']['name']);
	  	}else{
	  	  $image=$this->input->post('image_hidde');
	  	}

	  	$data=array('id_categorie'=>$id_categorie,
	  		        'id_sous_categorie'=>$id_sous_categorie,
	  		        'nom_produit'=>$nom_produit,
	  		        'quantite'=>$quantite,
	  		        'code_produit'=>1000,
	  		        'image'=>$image,
	  		        'id_fournisseur'=>$id_fournisseur,
	  		        'prix_unitaire_vente'=>$prix_unitaire_vente,
	  		        'prix_unitaire_achat'=>$prix_unitaire_achat
	  		      );
	  	$this->Model->update('Produit_Vendu',['id_produit'=>$id],$data);

	  	redirect('Produit_Vendu/Produit_Vendu');
   	}
     

     function detail($id){
       $data['produit_info']=$this->Model->readRequeteOne("SELECT p.*,c.descr_categorie,sc.descr_sous_categorie,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom,f.is_whatsapp,f.tel_client,f.email_fournisseur FROM Produit_Vendu p LEFT JOIN categorie c ON c.id_categorie=p.id_categorie LEFT JOIN sous_categorie_produit sc ON sc.id_sous_categorie=p.id_sous_categorie LEFT JOIN fournisseur f ON f.id_fournisseur=p.id_fournisseur WHERE id_produit=".$id."") ;
       $this->load->view('Produit_Detail_View',$data);
     }

     function upload_document($nom_file,$nom_champ){

      $ref_folder =FCPATH.'assets/images/Produit_Vendu';
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
 


