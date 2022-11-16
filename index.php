<?php
 
session_start();
 
if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        if($_POST['name'] != "rirififiloulou"){
            if($_POST['name'] != "Rirififiloulou"){
                function censor($sentence, $txtFile) {
                    $words = file($txtFile);
                    foreach ($words as $word) {
                        $word = trim($word);
                        $sentence = str_replace($word, str_repeat("*", strlen($word)), $sentence);
                    }
                    return $sentence;
                }

                $name = censor(strtolower($_POST['name']), "bad.txt");
                $name = censor(strtolower($name), "bad_name.txt");
                $name = substr($name, 0, 47);
                      
                $_SESSION['name'] = stripslashes(htmlspecialchars($name));
            }
            else{
                $_SESSION['name'] = stripslashes(htmlspecialchars("Antonin"));
            }
        }
        else{
            $_SESSION['name'] = stripslashes(htmlspecialchars("ADMIN"));
        }
   }
   else{
       echo '<span class="error">Please type in a different name</span>';
   }
}

function loginForm(){
    echo
    '<div id="loginform">
    <ul>
    <li><a class="img"><img src="totob12icon.png" alt="Logo" height="44"></a></li>
    <li><a class="icon" href="https://totob12.github.io/index.html"><span class="material-symbols-outlined">
    home</span></a></li>
    <li><a class="icon active" href="https://TotoB12-Chat.totob12.repl.co/"><span class="material-symbols-outlined">
    forum</span><h10 class=cc>Social</h10></a></li>
    <li><a class="icon" href="https://totob12.github.io/things/inpainting-forward.html"><span class="material-symbols-outlined">
    format_paint</span><h10 class="cc">Paint</h10></a></li>
    <li><a class="icon" href="https://chill-radio.totob12.repl.co/"><span class="material-symbols-outlined">
    radio</span><h10 class="cc">Radio</h10></a></li>
    <li><a class="icon" href="https://totob12.github.io/things/games.html"><span class="material-symbols-outlined">
    sports_esports</span><h10 class="cc">Games</h10></a></li>
    <li><a class="icon" href="https://totob12.github.io/things/sites.html"><span class="material-symbols-outlined">
    handyman</span><h10 class="cc">Random</h10></a></li>
    <li><a class="icon right" href="https://totob12.github.io/things/feedback.html"><span class="material-symbols-outlined">
    alternate_email</span></a></li>
    <li><a class="icon right" href="https://totob12.github.io/things/countdown.html"><span class="material-symbols-outlined">
    hourglass_empty</span></a></li>
    </ul>
    <a href="https://totob12.github.io/">
    <h4 class="title"><img class="titleimg" src="totob12titlechat.png" align="center" width=60%></h4></a>
    <div class="box">
    <div class="panel">
    <div class="textbox">
    <h3 style="margin-top: 16px;">FORUM</h3>
    <hr style="color: #c3e0e5; background-color: #c3e0e5;border-width:0;height:1.5px;margin: 16px 0px;">
    <h4 style="text-align:justify;">TotoB12 forum allow you to post pictures and much more, like on reddit!</h4>
    <button class="b1" style="font-size: 18px;" onclick="window.location.href="https://totob12.flarum.cloud/";">Go to the forum</button>
    </div>
    </div>
    <div class="chatbox">
    <h2>JOIN THE CHAT</h2>
    <img class="welcomelogo" src="totob12iconchat.png" alt="logo" width=25%>
    <h3><strong>Please enter your name to continue</strong></h3>
    <br>
    <h4>This server is under constant moderation.</h4>
    <h4>It\'s improper usage will result in a ban.</h4>
    <h4>Every message is permanent.</h4>
    <h4>To contact Admin, please mention <strong>@admin</strong> in your message.</h4>
    <h4>By using this service, you accept it\'s <a class="tou" href = "terms.html" target = "_self">Terms Of Use.</a></h4>
    <form action="index.php" method="post">
      <label class="text" for="name">Name →</label>
      <input class="text" type="text" name="name" id="name" />
      <input type="submit" name="enter" id="enter" value="ENTER" />
    </form>
    </div>
    </div>
  </div>';
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
     
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="totob12icon.png">
        <link rel="icon" type="image/x-icon" href="totob12icon.png">
        <title>TotoB12 Chat</title>
        <meta name="description" content="TotoB12 Chat" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

      <style>

        body {
          background-color: #1a1d21; 
          margin: 0px;
        }

        #loginform {
          background-color: #1a1d21;
        }

        h4 {
          color: #C3E0E5;
          font-family: "Century Gothic", "Monospace";
        }

        h3 {
          color: #C3E0E5;
          font-family: "Century Gothic", "Monospace";
          font-size: 22px;
        }

        h2 {
          color: #C3E0E5;
          font-family: "Century Gothic", "Monospace";
          font-size: 22px;
          margin-top: 16px;
        }
        
        .text {
          color: white;
          font-family: "Century Gothic", "Monospace";
        }

        .welcomelogo {
          margin: 16px 16px;
        }

        .title { 
        background-color: #274472;
        color: #C3E0E5;
        margin: 0px; 
        padding: 0 0;
        font-family: "Century Gothic", "Monospace";
        font-size: 64px;
        text-align: center;
        } 

        .tou {
          color: #f44336;
        }

        #enter {
          color: white;
          background-color: #5885AF;
          border: 2px solid #C3E0E5;
          font-family: "Century Gothic", "Monospace";
          opacity: 1;
        }

        #enter:hover {
          opacity: 0.8;
        }

        .welcome {
          background-color: #274472;
          color: #C3E0E5;
          padding: 32px 16px; 
          margin: 0px; 
          font-family: "Century Gothic", "Monospace";
          font-size: 64px;
          text-align: center;
        }

        .logout {
          text-align: center;
        }

        .panel {
          float:left;
          background-color: #1B2B44;
          border-radius: 12px;
          width: 25%;
        }

        .panel:hover {
         border: 2px solid #274472;
        }

        .panel-title {
          text-align: left;
        }

        .chatbox {
          border: 2px solid #274472;
          border-radius: 12px;
          float: right;
          width: 70%;
          margin-left: 16px;
        }

        .box {
          margin: 16px 16px;
        }

        .textbox {
          margin: 0px 16px;
        }

        @media only screen and (max-width: 1100px) {
  .panel, .chatbox {
    width: 100%;
    margin-bottom: 16px;
          }
        }

      </style>
    </head>
    <body>
    <?php
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
              <ul>
    <li><a class="img"><img src="totob12icon.png" alt="Logo" height="44"></a></li>
    <li><a class="icon" href="https://totob12.github.io/index.html"><span class="material-symbols-outlined">
    home</span></a></li>
    <li><a class="icon active" href="https://TotoB12-Chat.totob12.repl.co/"><span class="material-symbols-outlined">
    forum</span><h10 class=cc>Social</h10></a></li>
    <li><a class="icon" href="https://totob12.github.io/things/inpainting-forward.html"><span class="material-symbols-outlined">
    format_paint</span><h10 class="cc">Paint</h10></a></li>
    <li><a class="icon" href="https://chill-radio.totob12.repl.co/"><span class="material-symbols-outlined">
    radio</span><h10 class="cc">Radio</h10></a></li>
    <li><a class="icon" href="https://totob12.github.io/things/games.html"><span class="material-symbols-outlined">
    sports_esports</span><h10 class="cc">Games</h10></a></li>
    <li><a class="icon" href="https://totob12.github.io/things/sites.html"><span class="material-symbols-outlined">
    handyman</span><h10 class="cc">Random</h10></a></li>
    <li><a class="icon right" href="https://totob12.github.io/things/feedback.html"><span class="material-symbols-outlined">
    alternate_email</span></a></li>
    <li><a class="icon right" href="https://totob12.github.io/things/countdown.html"><span class="material-symbols-outlined">
    hourglass_empty</span></a></li>
    </ul>
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p><br>
            </div>
            <div id="menu">
                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            </div>
 
            <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
 
            <form name="message" action="">
                <input name="usermsg" aria-label="Message" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>
        <!-- jquery.min.js = https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js -->
        <script type="text/javascript" src=jquery.min.js></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadLog, 2500);
 
                $("#exit").click(function () {
                     var exit = confirm("Are you sure you want to exit the session?");
                    if (exit == true) {
                    window.location = "index.php?logout=true";
                    }
                });
            });
        </script>
    </body>
</html>
<?php
}
?>
