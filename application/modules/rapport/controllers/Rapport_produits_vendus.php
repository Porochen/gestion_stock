<?php
class Rapport_produits_vendus extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	public function  index()
	{
	   $db=$this->Model->readRequete("SELECT produits.id_produit , produits.nom_produit,SUM(produit_vendu.quantite_vendue) AS QTE FROM produits join produit_vendu where produits.id_produit=produit_vendu.id_produit GROUP BY (produits.id_produit)" );
		
		$total1=0;
	    $total=0;
	    $donnees="";
	    $categorie='';
	    foreach ($db as  $value) 
	    {
	      $categorie.="'";
	      $name=(!empty($value['nom_produit'])) ? $value['nom_produit'] : "Aucun" ;
	      $key_id=($value['id_produit']>0) ? $value['id_produit'] : "0" ;
	      $nom=str_replace("'", "\'", $name);
	      $nb=($value['QTE']>0) ? $value['QTE'] : "0" ;
	      $categorie .= $nom."',";
	      $donnees.="{y:".$nb.",key:".$key_id.",desc:'".$value['nom_produit']."'},";
	      $total=$total+$nb;
	    }
	    $data['categorie']=$categorie;
	    $data['donnees']=$donnees;
	    $data['total']=number_format($total,0,',',' ');
	    $this->load->view('rapport_produits_vendus_view',$data);
}
public function detail()
{
  $key=$this->input->post('key');
  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $query_principal='SELECT nom_client,montant_paye,quantite_vendue,numero_facture,payement_desc,solde_restante, ven.date_insertion FROM produits pro JOIN produit_vendu ven ON ven.id_produit=pro.id_produit LEFT JOIN mode_payement pay ON pay.id_mode_payement=ven.id_mode_payement  LEFT JOIN historique_facturation_produit fact ON fact.id_produit_vendu=ven.id_produit_vendu WHERE pro.id_produit='.$key;
    $limit='LIMIT 0,20';

    $order_by='';
    $order_colum=array('ven.id_produit_vendu','ven.quantite_vendue','ven.montant_paye','ven.solde_restante','pay.payement_desc','ven.date_insertion');
    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY id_produit_vendu   DESC';
   $search = !empty($_POST['search']['value']) ? ("  AND (quantite_vendue LIKE '%$var_search%' OR nom_client LIKE '%$var_search%' OR solde_restante LIKE '%$var_search%' OR payement_desc LIKE '%$var_search%' OR ven.date_insertion LIKE '%$var_search%') ") : '';
   
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
      $sub_array[] = $row->quantite_vendue;
      $sub_array[] =$row->montant_paye;
      $sub_array[] =$row->numero_facture;
      $sub_array[] =$row->payement_desc;
      $sub_array[] =$row->solde_restante;
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
