<?php
 
class Push {
 
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some operation
    // in background when push is received
    private $is_background;
    private $notif_title;
    private $notif_body;
 
    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
 
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
        $res['data']['image'] = $this->image;
        $res['data']['payload'] = $this->data;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }

    public function setNotifTitle($notif_title) {
        $this->notif_title = $notif_title;
    }

    public function setNotifBody($notif_body) {
        $this->notif_body = $notif_body;
    }

    public function getNotifTitle() {
        return $this->notif_title;
    }

    public function getNotifBody() {
        return $this->notif_body;
    }
 
}
