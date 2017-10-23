<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . '/helpers/firebase.php';
require APPPATH . '/helpers/push.php';


class Passage_api extends REST_Controller {
	
	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        
        $this->load->model('models/Model_passage','Model_Passage');
    }

//***************************************************************************************************************************************
//***********************************************  JSON Response Handler  ***************************************************************
//***************************************************************************************************************************************     
    
    function res_result($response) {
        $this->response(array('Data'=>$response['data'],'ResponseCode' => $response['error_code'], 'ResponseMsg' => $response['message']),REST_Controller::HTTP_OK);
    }
  	
//***************************************************************************************************************************************
//***********************************************  External API Handler  ****************************************************************
//***************************************************************************************************************************************
    
    public function getPassage_get() {
        $result_passage = $this->Model_Passage->getPassage();

        if ($result_passage!=FALSE) {
            $message = "Success";
            $response = array('data'=>$result_passage, 'error_code'=>'0', 'message'=>$message);
        }
        else {
            $message = "Failed";
            $response = array('data'=>$result_passage, 'error_code'=>'500', 'message'=>$message);
        }

        return $this->res_result($response);
    }

    public function addPassage_post() {
        $passage_title = $this->post('passage_title');
        $passage_message = $this->post('passage_message');
        $passage_author = $this->post('passage_author');
        $passage_category = $this->post('passage_category');

        if (empty($passage_title) &&
            empty($passage_message) &&
            empty($passage_author) &&
            empty($passage_category)) {
            $passage_title = $_POST['passage_title'];
            $passage_message = $_POST['passage_message'];
            $passage_author = $_POST['passage_author'];
            $passage_category = $_POST['passage_category'];
        }

        $insert_passage = array('passage_title'=>$passage_title, 'passage_message'=>$passage_message, 'passage_author'=>$passage_author, 'passage_category'=>$passage_category);

        $result = $this->Model_Passage->addPassage($insert_passage);

        if ($result!=FALSE) {
            $message = "Success";
            $response = array('data'=>$result, 'error_code'=>'0', 'message'=>$message);
        }
        else {
            $message = "Failed";
            $response = array('data'=>$result, 'error_code'=>'500', 'message'=>$message);
        }

        return $this->res_result($response);
    }

    public function updatePassage_post() {
        $passage_title = $this->post('passage_title');
        $passage_message = $this->post('passage_message');
        $passage_author = $this->post('passage_author');
        $passage_category = $this->post('passage_category');
        $passage_id = $this->post('passage_id');

        if (empty($passage_title) &&
            empty($passage_message) &&
            empty($passage_author) &&
            empty($passage_category) &&
            empty($passage_id)) {
            $passage_title = $_POST['passage_title'];
            $passage_message = $_POST['passage_message'];
            $passage_author = $_POST['passage_author'];
            $passage_category = $_POST['passage_category'];
            $passage_id = $_POST['passage_id'];
        }

        $update_passage = array('passage_title'=>$passage_title, 'passage_message'=>$passage_message, 'passage_author'=>$passage_author, 'passage_category'=>$passage_category, 'passage_id'=>$passage_id);

        $result = $this->Model_Passage->editPassage($update_passage);

        if ($result!=FALSE) {
            $message = "Success";
            $response = array('data'=>$result, 'error_code'=>'0', 'message'=>$message);
        }
        else {
            $message = "Failed";
            $response = array('data'=>$result, 'error_code'=>'500', 'message'=>$message);
        }

        return $this->res_result($response);
    }

    public function deletePassage_post() {
        $passage_id = $this->post('passage_id');

        if (empty($passage_id)) {
            $passage_id = $_POST['passage_id'];
        }

        $delete_passage = array('passage_id'=>$passage_id);

        $result = $this->Model_Passage->deletePassage($delete_passage);

        if ($result!=FALSE) {
            $message = "Success";
            $response = array('data'=>$result, 'error_code'=>'0', 'message'=>$message);
        }
        else {
            $message = "Failed";
            $response = array('data'=>$result, 'error_code'=>'500', 'message'=>$message);
        }

        return $this->res_result($response);
    }
    
}

?>
