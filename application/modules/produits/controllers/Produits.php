<?php 
	/**
	 * @author uyc.tic@gmail.com
	 * niyodon
	 */
	class Produits extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index()
	    {
	      $this->load->view('produits/Produit_List_View');
	    	
	    }

	    function listing($key_search=''){
         $data['title']="Liste des produits";
         
         $critere = !empty($key_search) ? '  and (nom_produit LIKE "%'.$key_search.'%" OR prix_unitaire_achat LIKE "%'.$key_search.'%" OR prix_unitaire_vente LIKE "%'.$key_search.'%" OR quantite LIKE "%'.$key_search.'%" OR tel_client LIKE "%'.$key_search.'%" OR descr_categorie LIKE "%'.$key_search.'%" OR descr_sous_categorie LIKE "%'.$key_search.'%" OR nom_fournisseur LIKE "%'.$key_search.'%" OR prenom_fournisseur LIKE "%'.$key_search.'%")' : '';

         $data['produit_info']=$this->Model->readRequete("SELECT p.*,c.descr_categorie,sc.descr_sous_categorie,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom,f.is_whatsapp,f.tel_client,f.email_fournisseur FROM produits p LEFT JOIN categorie c ON c.id_categorie=p.id_categorie LEFT JOIN sous_categorie_produit sc ON sc.id_sous_categorie=p.id_sous_categorie LEFT JOIN fournisseur f ON f.id_fournisseur=p.id_fournisseur WHERE 1 ".$critere." ORDER BY p.date_insertion DESC") ;

         $data['produits']=$this->Model->readRequete('SELECT * FROM produits WHERE 1 ORDER BY nom_produit');
	      $data['modePayement']=$this->Model->readRequete('SELECT * FROM mode_payement WHERE 1 ORDER BY payement_desc');
        $data['fournisseur']=$this->Model->read('fournisseur');
	     $produit_info=$this->load->view('produits/Produit_List_Search_View',$data,TRUE);
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

		  $this->load->view('produits/Produit_Add_View',$data);
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
	      	$this->Model->create('produits',$data);
	      }
	      
	    }


	  function delete($id){

       $this->Model->delete('produits',array('id_produit'=>$id));
   	   $sms['sms']='<div class="alert alert-success text-center col-md-12 col-md-offset-2" id="message"><strong> Oup! </strong> 
                         produit supprimé avec succèss  ! .
                   </div>';
        $this->session->set_flashdata($sms) ;
   	    redirect('produits/Produits');
   	}

   	function update_view($id){
   	  $data['title']='Modification';
   	  $data['categories']=$this->Model->readRequete('SELECT * FROM categorie WHERE 1 ORDER BY descr_categorie');
      $data['fournisseur']=$this->Model->readRequete("SELECT f.id_fournisseur,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom FROM fournisseur f WHERE 1 ORDER BY f.nom_fournisseur");

   	  $data['product_info']=$this->Model->readRequeteOne('SELECT p.*,sc.descr_sous_categorie FROM produits p JOIN sous_categorie_produit sc ON sc.id_sous_categorie=p.id_sous_categorie WHERE p.id_produit='.$id.'');
   	  $this->load->view('produits/Produit_Update_View',$data);
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
	  	$this->Model->update('produits',['id_produit'=>$id],$data);

	  	redirect('produits/Produits');
   	}
     
     // DEBUT JEAN DE DIEU

     function detail($id){
       $data['produit_info']=$this->Model->readRequeteOne("SELECT p.*,c.descr_categorie,sc.descr_sous_categorie,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom,f.is_whatsapp,f.tel_client,f.email_fournisseur FROM produits p LEFT JOIN categorie c ON c.id_categorie=p.id_categorie LEFT JOIN sous_categorie_produit sc ON sc.id_sous_categorie=p.id_sous_categorie LEFT JOIN fournisseur f ON f.id_fournisseur=p.id_fournisseur WHERE id_produit=".$id."") ;
      $data['last_sell']=$this->Model->readRequete("SELECT p.nom_produit,v.quantite_vendue,v.montant_paye,m.payement_desc,date_format(v.date_insertion,'%Y-%m-%d') AS date_insertion,date_format(v.date_insertion,'%H:%i:%s') AS heure_insertion FROM produits p JOIN produit_vendu v ON p.id_produit= v.id_produit LEFT JOIN mode_payement m ON m.id_mode_payement=v.id_mode_payement WHERE p.id_produit=".$id." ORDER BY v.id_produit_vendu DESC LIMIT 3") ;
       $this->load->view('Produit_Detail_View',$data);
     }

     public function approvisionner($id)
{
      $quantite=$this->input->post('quantite_ajoutee');
      $prix_unitaire_vente=$this->input->post('prix_unitaire_vente');
      $prix_unitaire_achat=$this->input->post('prix_unitaire_achat');
      $id_fournisseur=$this->input->post('id_fournisseur');
      
      $sql=$this->Model->readOne('produits',array('id_produit'=>$id));
      
      $nbr_stocke=$sql['quantite_restante'] + $quantite;

      $data=array(
            'quantite'=>$nbr_stocke,
            'quantite_restante'=>$nbr_stocke,
            'prix_unitaire_vente'=>$prix_unitaire_vente,
            );
    
      
    $historique=array('quantite_initiale'=>$sql['quantite'],
                      'quantite_approvisionnee'=>$quantite,
                      'id_fournisseur'=>$id_fournisseur,
                      'prix_unitaire_vente'=>$prix_unitaire_vente,
                      'prix_unitaire_achat'=>$prix_unitaire_achat,
                      'id_produit'=>$id
              );
      $this->Model->update('produits',['id_produit'=>$id],$data);
      $this->Model->create('historique_approvisionnement_produit',$historique);
      redirect('produits/Produits');
}

function hist_approv($id_produit){

   $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
   $query_principal="SELECT hist.*,CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) AS nom FROM historique_approvisionnement_produit hist LEFT  JOIN fournisseur f ON f.id_fournisseur=hist.id_fournisseur WHERE id_produit=".$id_produit."";

   $limit='LIMIT 0,10';
   if($_POST['length'] != -1){
    $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
  }
  $order_by='';

  if (!empty($order_by)) {
      # code...
    $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY hist.id_historique  DESC';
  }

  $search = !empty($_POST['search']['value']) ? (" AND  (quantite_initiale LIKE '%$var_search%' OR quantite_approvisionnee LIKE '%$var_search%' OR prix_unitaire_achat LIKE '%$var_search%' OR prix_unitaire_vente LIKE '%$var_search%' OR CONCAT(f.nom_fournisseur,' ',f.prenom_fournisseur) LIKE '%$var_search%' OR date_insertion LIKE '%$var_search%') ") : '';
  $critaire ="";

  $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
  $query_filter=$query_principal.'  '.$critaire.' '.$search;
  $fetch_data = $this->Model->readData($query_secondaire); 
  $u=0; 
  $data = array();

  foreach ($fetch_data as $value) {

    $u++;
    $sub_array = array(); 
    $sub_array[] =$u;
    $sub_array[] = $value->quantite_initiale;
    $sub_array[] = $value->quantite_approvisionnee;
    $sub_array[] = $value->prix_unitaire_achat;
    $sub_array[] = $value->prix_unitaire_vente;
    $sub_array[] = $value->nom;
    $sub_array[] = $value->date_insertion;

    $data[] = $sub_array;
  }

  $output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" =>$this->Model->readAll_data($query_principal),
    "recordsFiltered" => $this->Model->read_filtred($query_filter),
    "data" => $data
  );

  echo json_encode($output);
}

    //FIN JEAN DE DIEU
     public function vente(){
       $data['produits']=$this->Model->read('produit_vendu_tempo');
	   $data['modePayement']=$this->Model->readRequete('SELECT * FROM mode_payement WHERE 1 ORDER BY payement_desc');
	   $data['provinces']=$this->Model->readRequete('SELECT * FROM provinces WHERE 1 ORDER BY province_name');
	      
	   $this->load->view('produits/Produit_Vendu_New_View',$data);
     }

     public function update_vente(){
       $id_produit=$this->input->post('id_produit');
       $montant_paye=$this->input->post('montant_paye');
       $quantite_vendue=$this->input->post('quantite_vendue');

       $data=array('quantite_vendue'=>$quantite_vendue,
                   'montant_paye'=>$montant_paye);
       $this->Model->update('produit_vendu_tempo',['id_produit'=>$id_produit],$data);
       echo $this->listing_vente();
     }

     public function listing_vente(){
       $produits=$this->Model->read('produit_vendu_tempo');

       $output='';
       if (!empty($produits)) { 
       $output.=  '<table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>Produit</th>
                  <th>Quantite</th>
                  <th>Solde</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>';

     
        foreach ($produits as $value) {  
    $output.=   '<tr>
                 <td>'.$value['produit'].'</td>
                 <td>
                  <div class="row">
                   <div class="col-md-3">
                    <input type="number" class="form-control" value="'.$value['quantite_vendue'].'" id="value_actualiser'.$value['id_produit'].'">
                    <input type="hidden" class="form-control" value="'.$value['prix_unitaire'].'" id="prix_unitaire'.$value['id_produit'].'">
                    </div>
                    <div class="col-md-1 mt-1">
                     <a href="javascript:void(0)" title="Actualiser" onclick="actualiser('.$value['id_produit'].')">
                       <i class="fa fa-sync" aria-hidden="true"></i>
                     </a>
                     </div>
                  </div>
                 </td>
                 <td>'.$value['montant_paye'].'</td>
                 <td>
                  <a href="javascript:void(0)">
                   <small class="badge badge-danger float-right" onclick="remove_to_cart('.$value['id_produit'].')">x</small>
                  </a>
                 </td>
               </tr>';
       } 
    $output.= '</tbody>
            </table>';
      }else{
	    echo '<div class="col-md-12">
	            <h6 class="text-center text-danger">No data found !</h6>
	         </div>';
         } 

       echo $output;

     }

     function upload_document($nom_file,$nom_champ){

      $ref_folder =FCPATH.'assets/images/produits';
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







###############< cart >###############


    public function add_to_cart(){

  	$id_produit=$this->input->post('id_produit');
  	$produit=$this->input->post('produit');
  	$quantite=$this->input->post('quantite');
  	$prix_unitaire=$this->input->post('prix_unitaire');
  	$image=$this->input->post('image');
 	
  	$montant_paye=$quantite*$prix_unitaire;

  	$data=array('id_produit'=>$id_produit,
                'produit' =>$produit,
                'quantite_vendue'=>$quantite,
                'montant_paye'=>$montant_paye,
                'solde_restante'=>0,
                'image'   =>$image,  
                'prix_unitaire'=>$prix_unitaire
              );
  	 $this->Model->create('produit_vendu_tempo',$data);
  	 echo $this->listing_to_card();

    }

// fonction qui mentient les donnees si on actualise le navigateur
  public function load_cart(){
  	$product=$this->Model->read('produit_vendu_tempo');
    $all_product=array();
  	foreach ($product as $value) {
  	  $all_product[]=$value['id_produit']; 
  	}
  	echo json_encode($all_product);
  }

  public function listing_to_card(){

  	$output='';
	$nb=0;
	$data_array=array();
	foreach ($this->Model->read('produit_vendu_tempo') as $value) {
		$nb++;
		$output.='<div class="media align-items-center mb-2">
                      <div class="">
                         <img class="avatar-40 rounded-small" src="'.base_url('assets/images/produits/'.$value['image']).'" alt="Image">
                      </div>
                      <div class="media-body ml-3">
                         <h6 class="mb-0">'.$value['produit'].'</h6>
                         <small class="badge badge-danger float-right">
                           '.$value['quantite_vendue']*$value['prix_unitaire'].'
                         </small>
                         <p class="mb-0">'.$value['quantite_vendue'].' 
                         x '.$value['prix_unitaire'].'</p>
                      </div>
                   </div>';
			}

	 if ($nb==0) {
	 	$output='';
	 }
     
     // $session=array('view_all'=>$nb);
     // $this->session->set_userdata($session);
	 $data_array=array('output'=>$output,'total'=>$nb);
	 echo json_encode($data_array) ;

  }


	  public function remove_to_cart(){
	  	$id_produit=$this->input->post('id_produit');
	  	$this->Model->delete('produit_vendu_tempo',['id_produit'=>$id_produit]);
	  	echo $this->listing_to_card();
	  }

	  public function remove_to_vente(){
	  	$id_produit=$this->input->post('id_produit');
	  	$this->Model->delete('produit_vendu_tempo',['id_produit'=>$id_produit]);
        echo $this->listing_vente();
	  }
 

    public function vente_produit(){
      $id_mode_payement=$this->input->post('id_mode_payement');
      $nom_client=$this->input->post('nom_client');
      $prenom_client=$this->input->post('prenom_client');
      $tel_client=$this->input->post('tel_client');
      $is_whatsapp=$this->input->post('is_whatsapp');
      $email_client=$this->input->post('email_client');
      $province_id=$this->input->post('province_id');
      $commune_id=$this->input->post('commune_id');
      $zone_id=$this->input->post('zone_id');
      $colline_id=$this->input->post('colline_id');
      $adresse_client=$this->input->post('adresse_client');
      $montant_paye=$this->input->post('montant_paye');

      $solde=0;


      $ventes=$this->Model->read('produit_vendu_tempo');

      if ($id_mode_payement==1) {
      	foreach ($ventes as $value) {
        //enregistrement du produit payé en cash
      	$data=array('quantite_vendue'=>$value['quantite_vendue'],
                    'montant_paye'=>$value['montant_paye'],
                    'solde_restante'=>$value['solde_restante'],
                    'id_produit'=>$value['id_produit'],
                    'id_mode_payement'=>$id_mode_payement,
                  );

    $this->Model->create('produit_vendu',$data);

    $qte_restante=$this->Model->readOne('produits',['id_produit'=>$value['id_produit']]);
    $reste=$qte_restante['quantite_restante']-$value['quantite_vendue'];
  	$data_pro=array('quantite_restante'=>$reste);
  	$this->Model->update('produits',['id_produit'=>$value['id_produit']],$data_pro);
  	    }

      } else {
    
    foreach ($ventes as $value) {

        $prix_a_paye=$value['quantite_vendue']*$value['prix_unitaire'];
        $solde=$montant_paye-$prix_a_paye;
        
        if ($solde>=0) {
        //enregistrement du produit vendu en dette (mais payé=statut 1)
        $data=array('quantite_vendue'=>$value['quantite_vendue'],
                    'montant_paye'=>$prix_a_paye,
                    'solde_restante'=>0,
                    'id_produit'=>$value['id_produit'],
                    'id_mode_payement'=>$id_mode_payement,
                    'statut'=>1
                  );
        $this->Model->create('produit_vendu',$data);

	    $qte_restante=$this->Model->readOne('produits',['id_produit'=>$value['id_produit']]);
	    $reste=$qte_restante['quantite_restante']-$value['quantite_vendue'];
	  	$data_pro=array('quantite_restante'=>$reste);
	  	$this->Model->update('produits',['id_produit'=>$value['id_produit']],$data_pro);


        } else {
        //enregistrement du produit vendu en dette
        $data=array('quantite_vendue'=>$value['quantite_vendue'],
                    'montant_paye'=>$montant_paye,
                    'solde_restante'=>$solde,
                    'id_produit'=>$value['id_produit'],
                    'id_mode_payement'=>$id_mode_payement,
                    'statut'=>0
                  );

        $this->Model->create('produit_vendu',$data);

	    $qte_restante=$this->Model->readOne('produits',['id_produit'=>$value['id_produit']]);
	    $reste=$qte_restante['quantite_restante']-$value['quantite_vendue'];
	  	$data_pro=array('quantite_restante'=>$reste);
	  	$this->Model->update('produits',['id_produit'=>$value['id_produit']],$data_pro);
        
        //enregistrement du client en cas de dette

          $data_client=array('id_produit_vendue'=>$value['id_produit'],
	                         'nom_client'=>$nom_client,
	                         'prenom_client'=>$prenom_client,
	                         'tel_client'=>$tel_client,
	                         'is_whatsapp'=>$is_whatsapp,
	                         'email_client'=>$email_client,
	                         'province_id'=>$province_id,
	                         'commune_id'=>$commune_id,
	                         'zone_id'=>$zone_id,
	                         'colline_id'=>$colline_id,
	                         'adresse_client'=>$adresse_client
	                     );
  	      $id_client=$this->Model->createLastId('client',$data_client);
        
        //enregistrement de l'historique en cas de dette

          $data_histo=array('montant_paye'=>$montant_paye,
	  	                    'solde_restante'=>$solde,
	  	                    'id_produit_vendu'=>$value['id_produit'],
	  	                    'id_client'=>$id_client,
	  	                  );
          $this->Model->create('historique_paiement',$data_histo);
        }
        
        $montant_paye=$solde;

        if ($montant_paye<0) {
            $montant_paye=0;
          }	

    
  	    }
      }

	    $this->Model->vider('TRUNCATE produit_vendu_tempo');
	    echo $this->listing_vente();
   
   }








    ################< client info >##########

    public function get_all_communes(){
    $province_id=$this->input->post('province_id');
    $communes=$this->Model->read('communes',['province_id'=>$province_id]);
echo '<option value="">Séléctionner</option>';
      foreach ($communes as $commune) {  
echo '    <option value="'.$commune['commune_id'].'">
            '.$commune['commune_name'].'
          </option> ';
      } 
    }

    public function get_all_zones(){
    $commune_id=$this->input->post('commune_id');
    $zones=$this->Model->read('zones',['commune_id'=>$commune_id]);
echo '<option value="">Sélectionner</option>';
      foreach ($zones as $zone) {  
echo '    <option value="'.$zone['zone_id'].'">
            '.$zone['zone_name'].'
          </option> ';
      } 
  }

  public function get_all_collines(){
    $zone_id=$this->input->post('zone_id');
    $collines=$this->Model->read('collines',['zone_id'=>$zone_id]);
echo '<option value="">Sélectionner</option>';
      foreach ($collines as $colline) {  
echo '  <option value="'.$colline['colline_id'].'">
          '.$colline['colline_name'].'
        </option> ';
      } 
  }






}
 


