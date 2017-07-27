<?php
class autocomplete extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('mAutocomplete');
    }
    
    public function index(){
        $this->load->view('order/sertifikasi/view_demo2');
    }
    public function GetCountryName(){
        $keyword=$this->input->post('keyword');
        $data=$this->mAutocomplete->getRowCountry($keyword);        
        echo json_encode($data);
    }

    public function GetPerusahaanName(){
        $keyword=$this->input->post('keyword');
        $data=$this->mAutocomplete->getRowCustomer($keyword);        
        echo json_encode($data);
    }

}

?>