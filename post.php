<?php
session_start();
if(isset($_SESSION['name'])){
     
    function censor($sentence, $txtFile) {
        $words = file($txtFile);
        foreach ($words as $word) {
            $word = trim($word);
            $sentence = substr(str_replace($word, str_repeat("*", strlen($word)), $sentence), 0, 1000);
        }
        return $sentence;
    }

    $text = censor(strtolower($_POST['text']), "bad.txt");

    $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>
