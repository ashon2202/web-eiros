<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{
		if(isset($_GET['p'])){
			$p = $_GET['p'];
			$id = $_GET['id'];
		}else{
			$p='main';
			$id='';
		}
		$data['pagina']=$p;		
		$data['id']=$id;		
		$this->load->view('www/v_index',array_merge($data));

	}

	public function k()
	{
	    p($this->db1->orderby('t_imagen','id_multikey','FA00000001','RAND()'));

	}

	

}
