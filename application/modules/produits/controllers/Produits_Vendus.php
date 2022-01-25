<?php 
	/**
	 * @author uyc.tic@gmail.com
	 * Jean de Dieu
	 */
	class Produits_Vendus extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index()
	    {
	      $this->load->view('produits/Produit_Vendus_List_View');
	    	
	    }

	    function listing($key_search=''){
         

   $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
   $query_principal="SELECT quantite_vendue , montant_paye , solde_restante , nom_produit,code_produit , payement_desc , v.date_insertion  FROM produit_vendu v JOIN produits p ON p.id_produit=v.id_produit JOIN mode_payement m ON m.id_mode_payement=v.id_mode_payement";

   $limit='LIMIT 0,10';
   if($_POST['length'] != -1){
    $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
  }
  $order_by='';

  if (!empty($order_by)) {
      # code...
    $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY v.date_insertion  DESC';
  }

  $search = !empty($_POST['search']['value']) ? (" AND  (quantite_vendue LIKE '%$var_search%' OR montant_paye LIKE '%$var_search%' OR solde_restante LIKE '%$var_search%' OR nom_produit LIKE '%$var_search%' OR payement_desc LIKE '%$var_search%' OR v.date_insertion LIKE '%$var_search%' OR code_produit LIKE '%$var_search%') ") : '';
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
    $sub_array[] = $value->nom_produit;
    $sub_array[] = $value->code_produit;
    $sub_array[] = $value->quantite_vendue;
    $sub_array[] = $value->montant_paye;
    $sub_array[] = $value->solde_restante;
    $sub_array[] = $value->payement_desc;
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

  }