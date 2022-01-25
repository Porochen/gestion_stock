<?php
class Rapport_hist_soldes extends CI_Controller 
{
	function __construct()
  {
    parent::__construct();
  }
  public function  index()
  {
      $db=$this->Model->readRequete("SELECT  historique_solde.id_historique_solde,produits.nom_produit ,historique_solde.prix_unitaire_actuel FROM produits join historique_solde where produits.id_produit=historique_solde.id_produit GROUP BY (produits.id_produit)" );
    $serie="";
    foreach ($db as $key) 
    {
      $serie.=" {
            name: '".str_replace("'", "\'", $key['nom_produit']).''."',
            y: ".$key['prix_unitaire_actuel'].",
            key: ".$key['id_historique_solde']." },";
    }
    $dat=array('serie'=>$serie);
      $this->load->view('rapport_hist_soldes_view',$dat);
  }
  public function  detail()
  { 
      $key=$this->input->post('key');
        $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
        $query_principal='SELECT * FROM produits pro JOIN  historique_solde so ON pro.id_produit=so.id_produit  WHERE so.id_historique_solde='.$key;
    $limit='LIMIT 0,20';

    $order_by='';
    $order_colum=array('pro.nom_produit','so.prix_unitaire_ancien ','so.prix_unitaire_actuel','so.date_modification');
    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY prix_unitaire_ancien   DESC';
   $search = !empty($_POST['search']['value']) ? ("AND nom_produit LIKE '%$var_search%' prix_unitaire_ancien LIKE '%$var_search%'  OR prix_unitaire_actuel LIKE '%$var_search%' OR date_modification LIKE '%$var_search%') ") : '';
   
   $critaire =" ";
       
   $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
   $query_filter=$query_principal.'  '.$critaire;

   $fetch_pieces = $this->Model->readData($query_secondaire);
    
    $data = array();
    $u=1;
    foreach ($fetch_pieces as $row) 
    {

      $sub_array = array();
      $sub_array[] = $u++;
      $sub_array[] = $row->nom_produit;
      $sub_array[] =$row->prix_unitaire_ancien;
      $sub_array[] =$row->prix_unitaire_actuel;
      $sub_array[] =$row->date_modification;
      $data[] = $sub_array;
   }
   $output = array
   (
      "recordsTotal" =>$this->Model->readAll_data($query_principal),
      "recordsFiltered" => $this->Model->read_filtred($query_filter),
      "data" => $data
    );
   echo json_encode($output);
 }
}
