<?php
session_start();
if(isset($_SESSION['name'])){
     
    $badWords = array(
         'fuck' => 'f*ck',
         'shit' => 'sh*t',
	 'hell' => 'h*ll',
         'jesus' => 'j*sus',
         'god' => 'g*d',
         'anus' => '*n*s',
         'ass' => '*ss',
         'nazi' => 'n*z*',
         'hitler' => 'h*tl*r',
         'sex' => 's*x',
         'porn' => 'p*rn',
         'dick' => 'd*ck',
         'penis' => 'p*n*s',
         'cock' => 'c*ck',
         'clit' => 'cl*t',
         'vagina' => 'v*g*n*',
         'pussy' => 'p*ssy',
         'trump' => 'tr*mp',
         'badly' => '***');

    $text = strtr(strtolower($_POST['text']), $badWords);

    $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>
