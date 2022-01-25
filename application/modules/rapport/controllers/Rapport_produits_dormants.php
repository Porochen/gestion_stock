<?php
class Rapport_produits_dormants extends CI_Controller 
{
	
function __construct()
	{
		parent::__construct();
	}
	public function  index()
	{
	   $db=$this->Model->readRequete("SELECT   
    produits.id_produit,produits.nom_produit,produits.quantite from  produits where produits.id_produit  not in (select produit_vendu.id_produit from produit_vendu )" );
		
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
	      $nb=($value['quantite']>0) ? $value['quantite'] : "0" ;
	      $categorie .= $nom."',";
	      $donnees.="{y:".$nb.",key:".$key_id.",desc:'".$value['nom_produit']."'},";
	      $total=$total+$nb;
	    }
	    $data['categorie']=$categorie;
	    $data['donnees']=$donnees;
	    $data['total']=number_format($total,0,',',' ');
	    $this->load->view('rapport_produits_dormants_view',$data);
}
public function detail()
{
  $key=$this->input->post('key');
  $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
  $query_principal='SELECT * from  produits pro where pro.id_produit='.$key;
    $limit='LIMIT 0,20';

    $order_by='';
    $order_colum=array('pro.id_produit','pro.code_produit ','pro.quantite','pro.nom_produit','pro.prix_unitaire_achat','pro.prix_unitaire_vente','pro.image');

    $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY pro.quantite   DESC';
   $search = !empty($_POST['search']['value']) ? ("  AND (pro.nom_produit LIKE '%$var_search%')") : '';
   
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
      $sub_array[] = $row->code_produit;
      $sub_array[] =$row->prix_unitaire_achat;
      $sub_array[] =$row->prix_unitaire_vente;
      $sub_array[] =$row->quantite;
      
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
