
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grau_ed_f extends MY_Controller {

	// public function __construct(){parent::__construct();@user_akses('admin');}
	private $folder	 	= "grau_ed_f";

	public function index()
	{
        $data['userdata'] = $this->userdata;
		$data['folder']=$this->folder;
		$data['file']='index';
		$data['n_data']='Grau Edukasaun Formador';
		$data['tipu']='tbl';
		$data['win']='';		
		$this->load->view('layout/admin',array_merge($data));		
	}
	public function data(){
		$data['data']=$this->t->get('t_grau_ed_f');
		$this->load->view($this->folder.'/data',array_merge($data));		
	}

	public function form()
	{
		$data['data']='';
		$this->load->view($this->folder.'/form',array_merge($data));	
	}
	public function prosesu()
	{
		$DB=&get_instance()->t;
	if(isset($_POST["sobre"]) && $_POST["sobre"]=="foun" || $_POST["sobre"]=="renova"){
		$post=$this->input->post();
		$data = [
			'id_atualmente'	=> $_POST["id_atualmente"],
			'id_formador'	=> $_POST["id_formador"],
			'id_grau'	=> $_POST["id_grau"],
			'data_grauedf'	=> $_POST["data_grauedf"]
	];
	}	
		

		if(isset($_POST["sobre"]) && $_POST["sobre"]=="apagadadus"){
			$DB->delete("t_grau_ed_f",'id_atualmente',$_POST["apaga"]);
		}
		if(isset($_POST["sobre"]) && $_POST["sobre"]=="foun"){
			$DB->insert("t_grau_ed_f",$data);
		}
		if(isset($_POST["sobre"]) && $_POST["sobre"]=="renova"){			
			$DB->update("t_grau_ed_f",$data,'id_atualmente',$data['id_atualmente']);
		}
		$x['id_update']=autoKode('GRF','t_grau_ed_f','id_atualmente');
		$x['id_name']='#id_atualmente';
		echo json_encode($x);
	}

	public function loadformador(){
	$data = $this->t->get('t_formador',"t_formador.id_formador NOT In(SELECT t_grau_ed_f.id_formador from t_grau_ed_f)");?>
	<option selected value='' readonly>hili formador</option>
	<?php
		 foreach($data as $d): ?>
            <option value='<?=$d->id_formador;?>'> <?=$d->nrn_formador;?> </option>
  <?php endforeach;
	}


}
