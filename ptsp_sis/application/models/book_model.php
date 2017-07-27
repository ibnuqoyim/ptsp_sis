<?php
class Book_model extends CI_Model {
 
    public function getBook() {
        $query = $this->db->get( 'tb_book' );
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
 
    public function getMember() {
        $query = $this->db->get( 'tb_member' );
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
}
?>