<?php
class Rapport_hist_approv_produits extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	public function  index()
	{
     $db=$this->Model->readRequete("SELECT  historique_approvisionnement_produit.id_historique,produits.nom_produit,produits.id_produit,SUM(historique_approvisionnement_produit.quantite_approvisionnee) AS somme from historique_approvisionnement_produit join produits  where produits.id_produit=historique_approvisionnement_produit.id_produit GROUP BY (historique_approvisionnement_produit.id_produit)" );
	
		$donnees1="";
		$total1=0;
        foreach ($db as  $value) 
        {
	      $total1+=$value['somme'];
	      $name = (!empty($value['nom_produit'])) ? $value['nom_produit'] : "Aucun" ;
	      $key_id=($value['id_produit']>0) ? $value['id_produit'] : "0" ;
	      $nb=($value['somme']>0) ? $value['somme'] : "0" ;
	      $donnees1.="{name:'".str_replace("'","\'",$name)."', y:".$nb.",key:'".$key_id."'},"; 
	    }
	    $data['total1']=$total1;
	    $data['ser']=$donnees1;
	    $this->load->view('Rapport_hist_appr_produits_view',$data);
	}
	public function detail()
	{

      $key=$this->input->post('key');
      $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
       $query_principal='SELECT * FROM produits pro JOIN historique_approvisionnement_produit appr ON pro.id_produit=appr.id_produit WHERE pro.id_produit='.$key;
       $limit='LIMIT 0,10';

    $order_by='';

    $order_colum=array('pro.nom_produit','appr.quantite_initiale','appr.quantite_approvisionnee ','appr.solde_restante','appr.date_insertion');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY appr.quantite_initiale   DESC';

   $search = !empty($_POST['search']['value']) ? ("AND (pro.nom_produit LIKE '%$var_search%'  appr.date_insertion LIKE '%$var_search%') ") : '';
   
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
      $sub_array[] = $row->quantite_initiale;
      $sub_array[] =$row->quantite_approvisionnee;
      $sub_array[] =$row->date_insertion;
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
