<?php 

    if(!function_exists('generate_default_password')) {
        
        function generate_default_password() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass);
        }
    }
    
    if(!(function_exists('generate_code'))) {
    	function generate_code() {
    		$code_length = 3;
    		$min_value = pow(10,$code_length);
    		$max_value = pow(10,$code_length+1)-1;
    		$value = rand($min_value,$max_value);
    	
    		return $value;
    	}
    }
    
    if(!function_exists('validate_email')) {
        /**
         * @param $email_to_validate = email to be validated.
         * @param $valid_email_from_server = this is needed to sent email from in order to validate $email_to_validate 
         * */
        function validate_email($email_to_validate,$valid_email_from_server) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $ve = new VE\VerifyEmail($email_to_validate, $valid_email_from_server);
            return $ve->verify();
        }
    }
    
    if(!function_exists('send_mail_to_user')) {
        function send_mail_to_user($CI,$user_id,$username,$email_address,$default_password,$action) {
        	
            $from_email = "no-reply@truemoney.com.ph";
            $to_email = $email_address; 
            // Configure email library
             //ini_set('SMTP', ENV['smtp']['host']);
             $config['protocol'] = 'smtp';
             $config['smtp_host'] = 'ssl://smtp.googlemail.com';
             $config['smtp_port'] = 465;
             //$config['smtp_host'] = ENV['smtp']['host'];
             //$config['smtp_port'] = ENV['smtp']['port'];
			 //$config['smtp_user'] = '';
             //$config['smtp_pass'] = '';
             $config['smtp_user'] = 'danallanbray.santos@gmail.com';
             $config['smtp_pass'] = 'veilside';
             $config['mailtype'] = 'html';
             $config['validate'] = FALSE;
             $config['wordwrap'] = FALSE; 
             $config['charset'] = 'iso-8859-1';
            
            // Load email library and passing configured values to email library
            $CI->load->library('email', $config);
            $CI->email->set_newline("\r\n");
            
            // Sender email address
            //$CI->email->from($from_email, 'bray.santos0418');
            $CI->email->from($from_email);
            // Receiver email address
            $CI->email->to($to_email);
            $CI->email->subject('Welcome to the TMN Broadcast Assist');
            
            if ($action == "register") {
            	$CI->email->message('<h1>Registration Successful</h1>
                                            <p>Here is your user credential. Pincode will be sent on a separate email.</p>
                                            <br/>
                                            username: ' . $username . '
                                            <br/>
                                            password: ' . $default_password . '
                                            <br/>
                                            <br/>
                                            <p></p>');
            }
            else {
            	$CI->email->message('<h1>Forgot Password</h1>
                                            <p>Here is your user credential.</p>
                                            <br/>
                                            username: ' . $username . '
                                            <br/>
                                            password: ' . $default_password . '
                                            <br/>
                                            <br/>
                                            <p></p>');
            }
                                            
            if ($CI->email->send()) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    if(!function_exists('send_pincode_to_user')) {
        function send_pincode_to_user($CI,$username,$email_address,$verify_code) {
        	
            $from_email = "no-reply@truemoney.com.ph";
            $to_email = $email_address; 
            // Configure email library
             //ini_set('SMTP', ENV['smtp']['host']);
             $config['protocol'] = 'smtp';
             $config['smtp_host'] = 'ssl://smtp.googlemail.com';
             $config['smtp_port'] = 465;
             //$config['smtp_host'] = ENV['smtp']['host'];
             //$config['smtp_port'] = ENV['smtp']['port'];
			 //$config['smtp_user'] = '';
             //$config['smtp_pass'] = '';
             $config['smtp_user'] = 'danallanbray.santos@gmail.com';
             $config['smtp_pass'] = 'veilside';
             $config['mailtype'] = 'html';
             $config['validate'] = FALSE;
             $config['wordwrap'] = FALSE; 
             $config['charset'] = 'iso-8859-1';
            
            // Load email library and passing configured values to email library
            $CI->load->library('email', $config);
            $CI->email->set_newline("\r\n");
            
            // Sender email address
            //$CI->email->from($from_email, 'bray.santos0418');
            $CI->email->from($from_email);
            // Receiver email address
            $CI->email->to($to_email);
            $CI->email->subject('Welcome to the TMN Broadcast Assist');
            
            $CI->email->message('<h1>TMN Assist PIN</h1>
                                            <p>Your account ' . $username . ' has been verified. Use your pincode to access your settings.</p>
                                            <br/>
                                            Pincode: ' . $verify_code . '
                                            <br/>
                                            <br/>
                                            <p></p>');
                                            
            if ($CI->email->send()) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    if(!function_exists('is_email_exists')) {
        /**
         * $result = result of db query to get email.
         **/
        function is_email_exists($email,$CI) {
            $result = $CI->Model_Users->get_email($email);
            if(!empty($result)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    if(!function_exists('is_username_exists')) {
        /**
         * $result = result of db query to get email.
         **/
        function is_username_exists($user_id,$username,$CI) {
            $result = $CI->Model_Users->get_user_by_id($username,$user_id);
            if(!empty($result)) {
                return true;
            } else {
                return false;
            }
        }
    }    
    
    if(!function_exists('is_user_exists')) {
        /**
         * $result = result of db query to get email.
         **/
        function is_user_exists($username,$CI) {
            $result = $CI->Model_Users->get_user_id($username);
            if(!empty($result)) {
                return true;
            } else {
                return false;
            }
        }
    } 
    
    if(!function_exists('check_duplicate_credential')) {
        function check_duplicate_credential($CI,$valToCheck,$valToCheckField,$user_id,$action) {
            return $CI->Model_Users->check_duplicate_credential($valToCheck,$valToCheckField,$user_id,$action);
        }
    }
    
    if(!function_exists('get_current_timestamp')) {
        function get_current_timestamp() {
            
            $date = new DateTime();
            return $date->format('Y-m-d H:i:s');
        }
    }

    if (!function_exists('startConnection')) {
        function startConnection($api_task,$request_params) {
            require_once APPPATH . 'config/config.php';
 
            // Set POST variables
            $url = 'https://demo-partner.truemoney.com.ph/api/external/'.$api_task;
 
            $headers = array(
                'Authorization: Basic ' . base64_encode('admin:1234'),
               'Content-Type: application/json'
            );

            // Open connection
            $ch = curl_init();
 
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
 
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_params));
 
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
 
            // Close connection
            curl_close($ch);
 
            return json_decode($result, true);
        }
    }

    if (!function_exists('terminalConnection')) {
        function terminalConnection($api_task,$request_params) {
            require_once APPPATH . 'config/config.php';
 
            // Set POST variables
            $url = 'https://qa-api.tmn.ph/api/edc/'.$api_task;

            $headers = array(
               // 'Authorization: Basic ' . base64_encode('admin:1234'),
               'Content-Type: application/x-www-form-urlencoded'
            );

            // Open connection
            $ch = curl_init();
 
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
 
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_params));
 
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
 
            // Close connection
            curl_close($ch);
 
            return json_decode($result, true);
        }
    }

?>
