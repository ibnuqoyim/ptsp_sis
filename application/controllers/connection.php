<?php
class connection extends CI_Controller {
	
	public function __construct() {
       parent::__construct();
	   
		$this->load->model('mCustomer');
		$this->load->model('mkomoditi');
		$this->load->model('mlaporan');
		$this->load->model('morder');
		$this->load->model('mtarif');
		$this->load->model('msmm');
		$this->load->model('muser');
	}
	
	public function check_user(){
		$userid = $this->input->post("user_id");
		$password = $this->input->post("password");
		$data = $this->muser->check_user($userid, md5($password));
		
		echo json_encode($data);
	}
   	public function load_master() {
       $data = $this->msmm->getMaster();
	   
	   echo json_encode($data);
  	}
	
	public function load_order($kd_customer) {
       $data = $this->morder->getUserOrder($kd_customer);
		
		echo json_encode($data);
	}
	
	public function load_status_order($kd_order) {
       $data = $this->morder->getStatusOrder($kd_order);
	   
	   echo json_encode($data);
  	}
}
?>