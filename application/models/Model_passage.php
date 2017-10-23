<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Passage extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPassage()
  	{
  		$result = $this->db->get('tbl_passage_detail','tbl_passage_detail');
  		
  		return $result->result_array();
  	}
  	
    public function addPassage($data) {
        $this->db->trans_start();

        $this->db->insert('tbl_passage_detail',$data);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function editPassage($data) {

        $passage_title = $data['passage_title'];
        $passage_message = $data['passage_message'];
        $passage_author = $data['passage_author'];
        $passage_category = $data['passage_category'];
        $passage_id = $data['passage_id'];

        $this->db->trans_start();

        $sql = "UPDATE tbl_passage_detail SET passage_title='$passage_title', passage_message='$passage_message', passage_author='$passage_author', passage_category='$passage_category' WHERE passage_id='$passage_id'";

        $this->db->query($sql);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function deletePassage($data) {

        $passage_id = $data['passage_id'];

        $this->db->trans_start();

        $sql = "DELETE FROM tbl_passage_detail WHERE passage_id=$passage_id";

        $this->db->query($sql);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }
}
?>
