<?php 
class Produk extends CI_Controller {
    public function __construct() {
        	parent::__construct(); 
		      $this->load->model('mAutocomplete');
    }

    public function index(){
    	$this->load->view('view_coba');
    }

     //isi controller
    public function search() {  
        //if(isset($_GET['term'])){
            $result = $this->mAutocomplete->search($_GET['term']);
            if(count($result) > 0){
                foreach ($result as $pr) 
                    $arr_result[] = $pr->nama;                
                echo json_encode($arr_result) ;  
            }
        //}
     }  
}