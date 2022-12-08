<?php
session_start();
if(isset($_SESSION['name'])) {

    function censor($sentence, $txtFile) {
        $words = file($txtFile);
        foreach ($words as $word) {
            $word = trim($word);
            $sentence = substr(str_replace($word, str_repeat("*", strlen($word)), $sentence), 0, 1000000000);
        }
        return $sentence;
    }

    $text = censor(strtolower($_POST['text']), "bad.txt");
    $profileurl = $_SESSION['profileurl'];
     
    if(($text != "") && ($text != " ") && ($profileurl != "") && ($profileurl != " ")){
        date_default_timezone_set("America/New_York"); 
        $text_message = "<div class='msgln'><img class='user-img' src='$profileurl' width='35'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b>".stripslashes(htmlspecialchars($text))."<br></div>";
        file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
    } elseif(($text != "") && ($text != " ")){
        date_default_timezone_set("America/New_York"); 
        $text_message = "<div class='msgln'><img class='user-img' src='user.png' width='35'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b>".stripslashes(htmlspecialchars($text))."<br></div>";
        file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
    } else {
        echo '<span class="error">Please type in a message</span>';
    }
}
?>