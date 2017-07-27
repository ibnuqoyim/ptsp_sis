<?php
class Book_con extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
    }
    public function index() {
        $this->load->view('book_view');
    }
    public function readBook() {
        echo json_encode( $this->book_model->getBook() );
    }
    public function readMember() {
        echo json_encode( $this->book_model->getMember() );
    }
}
?>