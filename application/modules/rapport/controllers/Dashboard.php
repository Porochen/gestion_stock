<?php
/**
 * @author JD
 */
class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
  {


    $vend="SELECT pro.nom_produit AS NAME,pro.id_produit AS ID,SUM(ven.quantite_vendue) as NBR,pro.prix_unitaire_achat*quantite  as PA,pro.prix_unitaire_vente*quantite  as PV,pro.prix_unitaire_vente FROM produits pro LEFT JOIN produit_vendu ven ON ven.id_produit=pro.id_produit WHERE 1 group by NAME ";
    
    $prod=$this->Model->readRequete($vend);

    
    $categorie='';
    $donnees_vend='';
    $vend_total=0;
    $achats_total=0;
    $donnees_achats='';
    $benefice_total=0;
    $donnees_ben='';
    $donnees_paye='';
    $paye_total=0;
    foreach ($prod as  $value) {

      $categorie.="'";
      $name = (!empty($value['NAME'])) ? $value['NAME'] : "Aucun" ;
      $key_id=($value['ID']>0) ? $value['ID'] : "0" ;
      $nom=str_replace("'", "\'", $name);
      $categorie .= $nom."',";

      $achat=($value['PA']>0) ? $value['PA'] : "0" ;
      $achats_total=$achats_total+$achat;
      $donnees_achats.= "{y:".$achat.",desc:'".$value['NAME']."',key:".$key_id."},";

      $vend=($value['PV']>0) ? $value['PV'] : "0" ;
      $vend_total=$vend_total+$vend;
      $donnees_vend.= "{y:".$vend.",desc:'".$value['NAME']."',key:".$key_id."},";

      $paye=$value['prix_unitaire_vente']*$value['NBR'];
      $paye_total=$paye_total+$paye;

      $donnees_paye.= "{y:".$paye.",desc:'".$value['NAME']."',key:".$key_id."},";

      $coleur="";
      $benefice_total=$vend_total-$achats_total;

      $ben_pro=$paye-$achat;
      $donnees_ben.= "{y:".$ben_pro.",desc:'".$value['NAME']."',key:".$key_id."},";

    }
    $data['categorie']=$categorie;
    $data['donnees_vend']=$donnees_vend;
    $data['vend_total']=$vend_total;
    $data['donnees_ben']=$donnees_ben;
    $data['benefice_total']=$benefice_total;
    $data['donnees_paye']=$donnees_paye;
    $data['paye_total']=$paye_total;


    $data['achats_total']=$achats_total;
    $data['donnees_achats']=$donnees_achats;
    
    $stocke="SELECT pro.nom_produit AS NAME,pro.id_produit AS ID,pro.quantite as NBR FROM produits pro";


    $stock=$this->Model->readRequete($stocke);

    $total1=0;


    $donnees1="";
    foreach ($stock as  $value) {
      $total1+=$value['NBR'];
      $name = (!empty($value['NAME'])) ? $value['NAME'] : "Aucun" ;
      $key_id=($value['ID']>0) ? $value['ID'] : "0" ;
      $nb=($value['NBR']>0) ? $value['NBR'] : "0" ;

      $donnees1.="{name:'".str_replace("'","\'",$name)."', y:".$nb.",desc:'".$value['NAME']."',key:'".$key_id."'},";
      
    }


    $data['total1']=$total1;
    $data['donnees1']=$donnees1;


    $restante="SELECT pro.nom_produit AS NAME,pro.id_produit AS ID,pro.quantite_restante as NBR FROM produits pro";


    $rest=$this->Model->readRequete($restante);

    $total2=0;


    $donnees2="";
    foreach ($rest as  $value) {
      $total2+=$value['NBR'];
      $name = (!empty($value['NAME'])) ? $value['NAME'] : "Aucun" ;
      $key_id=($value['ID']>0) ? $value['ID'] : "0" ;
      $nb=($value['NBR']>0) ? $value['NBR'] : "0" ;

      $donnees2.="{name:'".str_replace("'","\'",$name)."', y:".$nb.",desc:'".$value['NAME']."',key:'".$key_id."'},";
      
    }


    $data['total2']=$total2;
    $data['donnees2']=$donnees2;


    //dette

    $serie="";
    $tot=0;
    foreach ($prod as $value) {
      $nb=($value['NBR']>0) ? $value['NBR'] : "0" ;
      $serie.=" {
            name: '".str_replace("'", "\'", $value['NAME']).':'."',
            y: ".$nb.",
            key: ".$value['ID']."
        },";
          $montant=$value['NBR'];
          $tot+=$value['NBR'];
    }

     $data['serie']=$serie;
     $data['tot']=$tot;
     $data['montant']=$montant;

     
    //EVOLUTION

     $EVOL="SELECT produits.id_produit AS ID, SUM(produits.prix_unitaire_achat) AS PA,SUM(produits.prix_unitaire_vente) AS PV,date_format(produits.date_insertion,'%M') AS PERIODE FROM `produits` GROUP BY date_format(produits.date_insertion,'%m') ";
    
    $evolution=$this->Model->readRequete($EVOL);
    
    $total1=0;

    $categorie_evol="";
    $donnee_evol_pa="";
    $donnee_evol_pv="";
    foreach ($evolution as  $value) {

      $categorie_evol.="'";


      $name_ = (!empty($value['PERIODE'])) ? $value['PERIODE'] : "Aucun" ;
      $name=$this->dateToFrench($name_,'F');
      $key_id=($value['ID']>0) ? $value['ID'] : "0" ;
      $nom=str_replace("'", "\'", $name);
      $categorie_evol.= $nom."',";
      
      $key_id=($value['ID']>0) ? $value['ID'] : "0" ;


      $donnee_evol_pa.="{name:'".str_replace("'","\'",$name)."', y:".$value['PA'].",desc:'".$value['PERIODE']."',key:'".$key_id."'},";

      $donnee_evol_pv.="{name:'".str_replace("'","\'",$name)."', y:".$value['PV'].",desc:'".$value['PERIODE']."',key:'".$key_id."'},";
      
    }

    $data['categorie_evol']=$categorie_evol;
    $data['donnee_evol_pv']=$donnee_evol_pv;
    $data['donnee_evol_pa']=$donnee_evol_pa;



    $data['title']='Dashboard pour tous les produits';
    $this->load->view('Dashboard_View',$data);


  }

  public function dateToFrench($date, $format) 
{
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, date($format, strtotime($date) ) );
}

  public function detail_vendu()
  {
    $key=$this->input->post('key');

      $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
      $query_principal='SELECT * FROM produits pro JOIN produit_vendu ven ON ven.id_produit=pro.id_produit LEFT JOIN mode_payement pay ON pay.id_mode_payement=ven.id_mode_payement WHERE pro.id_produit='.$key;

        $limit='LIMIT 0,10';

        $order_by='';
        
        $order_colum=array('ven.id_produit_vendu','ven.quantite_vendue','ven.montant_paye','ven.solde_restante','pay.payement_desc','ven.date_insertion');
        $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY id_produit_vendu   DESC';
         

       $search = !empty($_POST['search']['value']) ? ("  AND (quantite_vendue LIKE '%$var_search%' OR montant_paye LIKE '%$var_search%' OR solde_restante LIKE '%$var_search%' OR payement_desc LIKE '%$var_search%' OR ven.date_insertion LIKE '%$var_search%') ") : '';
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
          $sub_array[] = $row->quantite_vendue;
          $sub_array[] = $row->montant_paye;
          $sub_array[] =$row->solde_restante;
          $sub_array[] =$row->payement_desc;
          $sub_array[] =$row->date_insertion;

          $data[] = $sub_array;

              }
              
              $output = array(
                  
                  "recordsTotal" =>$this->Model->readAll_data($query_principal),
                  "recordsFiltered" => $this->Model->read_filtred($query_filter),
                  "data" => $data
              );
             
              echo json_encode($output);
  }

  public function detail_stock()
  {
    $key=$this->input->post('key');

      $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
      $query_principal='SELECT appro.quantite_initiale,appro.quantite_approvisionnee,CONCAT(fourn.nom_fournisseur," ",fourn.prenom_fournisseur) AS fournisseur,appro.prix_unitaire_achat,appro.prix_unitaire_vente,date_format(appro.date_insertion,"%Y-%m-%d") AS date_insertion  FROM historique_approvisionnement_produit appro LEFT JOIN fournisseur fourn ON appro.id_fournisseur=fourn.id_fournisseur WHERE appro.id_produit='.$key;

        $limit='LIMIT 0,10';

        $order_by='';
        
        $order_colum=array('appro.quantite_initiale','appro.quantite_approvisionnee','CONCAT(fourn.nom_fournisseur," ",fourn.prenom_fournisseur)','appro.prix_unitaire_achat','appro.prix_unitaire_vente','appro.date_insertion');
        $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_colum[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY date_insertion DESC';
         

       $search = !empty($_POST['search']['value']) ? ("  AND (quantite_initiale LIKE '%$var_search%' OR quantite_approvisionnee LIKE '%$var_search%' OR prix_unitaire_vente LIKE '%$var_search%' OR prix_unitaire_achat LIKE '%$var_search%' OR date_insertion LIKE '%$var_search%' OR CONCAT(fourn.nom_fournisseur,' ',fourn.prenom_fournisseur) LIKE '%$var_search%') ") : '';
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
          $sub_array[] = $row->quantite_approvisionnee;
          $sub_array[] =$row->fournisseur;
          $sub_array[] =$row->prix_unitaire_vente;
          $sub_array[] =$row->prix_unitaire_vente;
          $sub_array[] =$row->date_insertion;

          $data[] = $sub_array;

              }
              
              $output = array(
                  
                  "recordsTotal" =>$this->Model->readAll_data($query_principal),
                  "recordsFiltered" => $this->Model->read_filtred($query_filter),
                  "data" => $data
              );
             
              echo json_encode($output);
  }
}