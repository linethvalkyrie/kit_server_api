<?php
	define('ENV', json_decode( file_get_contents( $_SERVER['TMNASSISTAPPENV'] ), TRUE ) );
	
    $file_path = ENV['upload_dir'] /*'uploads/'*/;
    //echo $file_path;
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        echo "success";
    } else{
        echo "fail";
    }
 ?>
