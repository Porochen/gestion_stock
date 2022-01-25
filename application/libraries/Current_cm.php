<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

   class Current_cm {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

        public function current_class()
        {
                $class=$this->CI->router->fetch_class();
                $out_put='';

                if($class== 'Produits'||$class=='Fournisseur'||$class=='Achats'||$class=='Produit_vendu'||$class=='Dettes'||$class=='Client' || $class=='Produits_Vendus'){
                 $out_put='stock';       
                }

                if($class=='Dashboard') {
                  $out_put='dashboard';
                }

                if($class=='Categorie'|| $class=='Mode_Paiment'|| $class=='Produit_a_acheter'||$class=='Sous_categorie'||$class=='Mode_Unite_Mesure') {
                  $out_put='donnees';
                }

                if($class=='Utilisateurs'|| $class=='Settings') {
                  $out_put='settings';
                }

                if($class=='Rapport_hist_approv_produits'|| $class=='Rapport_hist_fact_produits'|| $class=='Rapport_hist_soldes'||$class=='Rapport_produits_dormants'||$class=='Rapport_produits_vendus') {
                  $out_put='Reporting';
                }

                return $out_put;
                
        }

        public function current_method()
        {
           $class=$this->CI->router->fetch_class();
           return $class;
        }

}