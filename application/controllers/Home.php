<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pegawai');
		$this->load->model('M_posisi');
		$this->load->model('M_kota');
		$this->load->library('curl');
	}

	public function index() {
		 $datacovid = json_decode($this->curl->simple_get('https://api.kawalcorona.com/indonesia/'));
		//print_r($datacovid); exit();
		$data['positif'] 	= @$datacovid[0]->positif;
		$data['sembuh'] 	= @$datacovid[0]->sembuh;
		$data['meninggal'] 		= @$datacovid[0]->meninggal;
		$data['dirawat'] 		= @$datacovid[0]->dirawat;
		$data['userdata'] 		= $this->userdata;

		$globalpositif = json_decode($this->curl->simple_get('https://api.kawalcorona.com/positif'));
		$data['glob_positif'] = @$globalpositif->value;

		$globalsembuh = json_decode($this->curl->simple_get('https://api.kawalcorona.com/sembuh'));
		$data['globalsembuh'] = @$globalsembuh->value;

		$globalmeninggal = json_decode($this->curl->simple_get('https://api.kawalcorona.com/meninggal'));
		$data['globalmeninggal'] = @$globalmeninggal->value;

		

		$data['page'] 			= "home";
		$data['judul'] 			= "News Covid";
		$data['deskripsi'] 		= "Covid 19";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */