<?php
session_start();
if(isset($_SESSION['name'])){

  $url = $_POST['text'];
    
    if(($url != "") && ($url != " ")){
        date_default_timezone_set("America/New_York"); 
        $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b><a href='$url' target='_blank'><img src='$url' width='200'></a><br></div>";
        file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
    }
    else{
        echo 'error';
    }
}
?>
