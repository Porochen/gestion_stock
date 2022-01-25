<?php
class Rapport_hist_fact_produits extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	public function  index()
	{
   $db=$this->Model->readRequete(
   	"SELECT p.id_produit ,p.nom_produit, historique_facturation_produit.nom_client,v.montant_paye,SUM(v.quantite_vendue) AS SOM from historique_facturation_produit JOIN produit_vendu v ON v.id_produit_vendu=historique_facturation_produit.id_produit_vendu JOIN produits p ON p.id_produit=v.id_produit GROUP BY (historique_facturation_produit.nom_client)" );
		$ser1="";
		 
    $donnees1="";
		$total1=0;
        foreach ($db as  $value) 
        {
	      $total1=$total1+$value['SOM'];
	      $name = (!empty($value['nom_produit'])) ? $value['nom_produit'] : "Aucun" ;
	      $key_id=($value['id_produit']>0) ? $value['id_produit'] : "0" ;
	      $nb=($value['SOM']>0) ? $value['SOM'] : "0" ;
	      $donnees1.="{name:'".str_replace("'","\'",$name)."', y:".$nb.",key:'".$key_id."'},"; 
	    }
	    $data['total1']=$total1;
	    $data['ser']=$donnees1;
	    $this->load->view('rapport_hist_fact_produits_view',$data);

		
	 
	}
	public function detail()
{
  $key=$this->input->post('key');
  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $query_principal='SELECT * FROM  historique_facturation_produit fac JOIN produit_vendu ven ON ven.id_produit_vendu=fac.id_produit_vendu JOIN produits p ON p.id_produit=ven.id_produit WHERE p.id_produit='.$key.' ';
    $limit='LIMIT 0,20';

    $order_by='';
    $order_colum=array('ven.id_produit_vendu','ven.quantite_vendue','ven.montant_paye','ven.solde_restante','ven.date_insertion');
    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY id_produit_vendu   DESC';
   $search = !empty($_POST['search']['value']) ? ("  AND (quantite_vendue LIKE '%$var_search%' OR nom_client LIKE '%$var_search%' OR solde_restante LIKE '%$var_search%' OR ven.date_insertion LIKE '%$var_search%') ") : '';
   
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
      $sub_array[] = $row->nom_client;
      $sub_array[] = $row->numero_facture;
      $sub_array[] = $row->quantite_vendue;
      $sub_array[] =$row->montant_paye;
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
}}
