<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit_Controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->model('Produit_Model','produits');
    $this->load->model('Mouvement_Model','mouvements');
	}

	public function index()
	{
        $data['produits'] = $this->produits->get_produits();
		$this->load->view('index',$data);
	}

	public function getProduit(){
       $idProduit = intval($this->input->post('idProduit'));
       echo json_encode($this->produits->getProduitById($idProduit));  
   }

   public function ravitailler(){
   		$idProduit = intval($this->input->post('idProduit'));
   		$quantite = floatval($this->input->post('quantite'));

      $data = array(
          'success' => false,
          'erreur' => ''
      );

      if ($quantite > 0) {
        $produit = $this->produits->getProduitById($idProduit);
        $stock = $produit[0]->STOCK + $quantite;

        $dataUpdate = array(
              'STOCK' => $stock
        );
        $dataConditions = array(
            "ID_PRODUITS" => $idProduit
        );

        $this->produits->update($dataUpdate,$dataConditions);

        $dataInsert = array(
          'ID_PRODUITS' => $idProduit,
          'QUANTITE' => $quantite,
          'TYPE' => 1,
          'DATE' => date("Y-m-d")
        );

        $this->mouvements->inserer($dataInsert);

        $data['stock'] = $stock;
        $data['success'] = true;
      }
      else{
        $data['erreur'] = 'Veuillez entrer une quantité positive!';
      }

      echo json_encode($data);
   }

   public function enlever(){
      $idProduit = intval($this->input->post('idProduit'));
      $quantite = floatval($this->input->post('quantite'));

      $data = array(
          'success' => false,
          'erreur' => ''
      );

      if ($quantite > 0) {
        $produit = $this->produits->getProduitById($idProduit);
        $stockActu = $produit[0]->STOCK;

        if ($stockActu > 0) {
          if ($stockActu >= $quantite) {
            $stock = $stockActu - $quantite;
            $dataUpdate = array(
                'STOCK' => $stock
            );
            $dataConditions = array(
                "ID_PRODUITS" => $idProduit
            );

            $this->produits->update($dataUpdate,$dataConditions);

            $dataInsert = array(
              'ID_PRODUITS' => $idProduit,
              'QUANTITE' => $quantite,
              'TYPE' => 0,
              'DATE' => date("Y-m-d")
            );

            $this->mouvements->inserer($dataInsert);

            $data['stock'] = $stock;
            $data['success'] = true;
          }
          else{
            $data['erreur'] = 'Il ne reste que ' . $stockActu . 'kg de ' . $produit[0]->NOM . ' en stock!';
          }
        }
        else{
          $data['erreur'] = 'Il ne reste plus rien en stock, pensez à ravitailler le stock de ' . $produit[0]->NOM . '!';
        }
      }
      else{
        $data['erreur'] = 'Veuillez entrer une quantité positive!';
      }

      echo json_encode($data);
   }
}
