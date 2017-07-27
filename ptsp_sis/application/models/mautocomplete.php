<?php
class mAutocomplete extends CI_Model{
     public function __construct() {
            parent::__construct(); 
    }

    
    /*public function getRowCountry($keyword) {        
        $this->db->order_by('id', 'DESC');
        $this->db->like("name", $keyword);
        return $this->db->get('country')->result_array();
    }
   
    public function getRowCustomer($keyword) {        
        $this->db->order_by('id', 'DESC');
        $this->db->like("nama", $keyword);
        return $this->db->get('customer')->result_array();
    }

    function getJasonCustomer($q){
        $this->db->select('*');
        $this->db->like('nama', $q);
        $query = $this->db->get('customer');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $new_row['label']=htmlentities(stripslashes($row['nama']));
                $new_row['value']=htmlentities(stripslashes($row['kd_customer']));
                $row_set[] = $new_row; //build an array
             }
            echo json_encode($row_set); //format the array into json data
        }
    }
    */
    public function search($nama) {  
        $this->db->like('nama', $nama);
        return $this->db->get('customer')->result();
    }



}
?>