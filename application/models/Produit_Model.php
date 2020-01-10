<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit_Model extends CI_Model {

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
	}

	public function get_produits()
	{
		return $this->db->select('*')
						->from('produits')
						->get()
						->result();
	}	

	public function getProduitById($id){
		$query = $this->db
				  ->select('*')
				  ->from('produits')
				  ->where('ID_PRODUITS = ' , $id)
				  ->get()
				  ->result();
		return $query;
	}

	public function update($dataUpdate,$dataConditions){
		$this->db->where($dataConditions);
		$this->db->update('produits', $dataUpdate);
	}
	
//	public function inserer($data){
//		$this->db->insert('produits', $data);
//	}	
		
}
