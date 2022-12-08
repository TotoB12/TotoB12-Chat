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
                $name = substr($name, 0, 1000000);
     
                $_SESSION['name'] = stripslashes(htmlspecialchars($name));

              
            }
            else{
                $_SESSION['name'] = stripslashes(htmlspecialchars("Antonin"));
            }
        }
        else{
            $_SESSION['name'] = stripslashes(htmlspecialchars("ADMIN"));
        }
   } else {
       echo '<span class="error">Please type in a different name</span>';
   }
  $profileurl = strtolower($_POST['profileurlimg']);
                      
  $_SESSION['profileurl'] = stripslashes(htmlspecialchars($profileurl));
}

function loginForm(){
    echo
    '<div id="loginform">
    <ul>
    <li><a class="img"><img src="totob12icon.png" alt="Logo" height="44"></a></li>
    <li><a class="icon" href="https://totob12.github.io/index.html"><span class="material-symbols-outlined">
    home</span></a></li>
    <li class="screen"><a class="icon active" href="https://TotoB12-Chat.totob12.repl.co/"><span class="material-symbols-outlined">
    forum</span><h10 class=cc>Social</h10></a></li>
    <li class="screen"><a class="icon" href="https://totob12.github.io/things/inpainting-forward.html"><span class="material-symbols-outlined">
    format_paint</span><h10 class="cc">Paint</h10></a></li>
    <li class="screen"><a class="icon" href="https://chill-radio.totob12.repl.co/"><span class="material-symbols-outlined">
    radio</span><h10 class="cc">Radio</h10></a></li>
    <li class="screen"><a class="icon" href="https://totob12.github.io/things/games.html"><span class="material-symbols-outlined">
    sports_esports</span><h10 class="cc">Games</h10></a></li>
    <li class="screen"><a class="icon" href="https://totob12.github.io/things/sites.html"><span class="material-symbols-outlined">
    handyman</span><h10 class="cc">Random</h10></a></li>
    <li class="screen"><a class="icon right" href="https://totob12.github.io/things/feedback.html"><span class="material-symbols-outlined">
    alternate_email</span></a></li>
    <li class="screen"><a class="icon right" href="https://totob12.github.io/things/countdown.html"><span class="material-symbols-outlined">
    hourglass_empty</span></a></li>
    <div class="dropdown" style="float:right;">
  <button class="dropbtn"><span class="material-symbols-outlined">menu</span></button>

  <div class="dropdown-content">
  <a href="https://totob12.github.io/index.html"><span class="material-symbols-outlined">home</span><div class="dropdowncc">Home</div></a>
  <a class="blanka" href=""></a>
  <a href="https://TotoB12-Chat.totob12.repl.co/"><span class="material-symbols-outlined">forum</span><div class="dropdowncc">Social</div></a>
  <a href="https://totob12.github.io/things/inpainting-forward.html"><span class="material-symbols-outlined">format_paint</span><div class="dropdowncc">Paint</div></a>
  <a href="https://chill-radio.totob12.repl.co/"><span class="material-symbols-outlined">radio</span><div class="dropdowncc">Radio</div></a>
  <a href="https://totob12.github.io/things/games.html"><span class="material-symbols-outlined">sports_esports</span><div class="dropdowncc">Games</div></a>
  <a href="https://totob12.github.io/things/sites.html"><span class="material-symbols-outlined">handyman</span><div class="dropdowncc">Random</div></a>
  <a class="blanka" href=""></a>
  <a href="https://totob12.github.io/things/countdown.html"><span class="material-symbols-outlined">hourglass_empty</span><div class="dropdowncc">Countdown</div></a>
  <a href="https://totob12.github.io/things/feedback.html"><span class="material-symbols-outlined">alternate_email</span><div class="dropdowncc">Contact</div></a>
  </div>
</div>
    </ul> 

    <div class="titlebox">
    <a href="https://totob12.github.io/">
    <h4 class="title"><img class="titleimg" src="totob12titlechat.png" align="center" width=60%></h4></a>
    </div>
    <div class="box">
    <div class="panel">
    <div class="textbox">
    <h3 style="margin-top: 16px;">FORUM</h3>
    <hr style="color: #c3e0e5; background-color: #c3e0e5;border-width:0;height:1.5px;margin: 16px 0px;">
    <h4>TotoB12 forum allow you to post pictures and much more, like on reddit!</h4>
    <a href="https://totob12.flarum.cloud"><button class="b1" style="font-size: 18px;">Go to the forum</button></a>
    </div>
    </div>
    <div class="chatbox">
    <div class="chatboxlogin">
    <h2><strong>JOIN THE CHAT</strong></h2>
    <img class="welcomelogo" src="totob12iconchat.png" alt="logo" width=25%>
    <h3>Please enter your name to continue</h3>
    <br>
    <p>This server is under constant moderation.<br>
    It\'s improper usage will result in a ban.<br>
    Every message is permanent.<br>
    To contact Admin, please mention <strong>@admin</strong> in your message.<br>
    By using this service, you accept it\'s <a class="tou" href = "terms.html" target = "_self">Terms Of Use.</a></p>
    <form action="index.php" method="post">
      <input class="text" type="text" name="name" id="name" placeholder="Enter your name..."/><br><br>
      <input class="text" type="url" name="profileurlimg" id="profileurlimg" placeholder="Enter profile image url... (optional)"/><br><br>
      <input type="submit" name="enter" id="enter" value="ENTER" />
    </form>
    </div>
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <title>TotoB12 Chat</title>
        <meta name="description" content="TotoB12 Chat" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
    <li class="screen"><a class="icon active" href="https://TotoB12-Chat.totob12.repl.co/"><span class="material-symbols-outlined">
    forum</span><h10 class=cc>Social</h10></a></li>
    <li class="screen"><a class="icon" href="https://totob12.github.io/things/inpainting-forward.html"><span class="material-symbols-outlined">
    format_paint</span><h10 class="cc">Paint</h10></a></li>
    <li class="screen"><a class="icon" href="https://chill-radio.totob12.repl.co/"><span class="material-symbols-outlined">
    radio</span><h10 class="cc">Radio</h10></a></li>
    <li class="screen"><a class="icon" href="https://totob12.github.io/things/games.html"><span class="material-symbols-outlined">
    sports_esports</span><h10 class="cc">Games</h10></a></li>
    <li class="screen"><a class="icon" href="https://totob12.github.io/things/sites.html"><span class="material-symbols-outlined">
    handyman</span><h10 class="cc">Random</h10></a></li>
    <li class="screen"><a class="icon right" href="https://totob12.github.io/things/feedback.html"><span class="material-symbols-outlined">
    alternate_email</span></a></li>
    <li class="screen"><a class="icon right" href="https://totob12.github.io/things/countdown.html"><span class="material-symbols-outlined">
    hourglass_empty</span></a></li>
  <div class="dropdown" style="float:right;">
  <button class="dropbtn"><span class="material-symbols-outlined">menu</span></button>
  <div class="dropdown-content">
  <a href="https://totob12.github.io/index.html"><span class="material-symbols-outlined">home</span><div class="dropdowncc">Home</div></a>
  <a class="blanka" href=""></a>
  <a href="https://TotoB12-Chat.totob12.repl.co/"><span class="material-symbols-outlined">forum</span><div class="dropdowncc">Social</div></a>
  <a href="https://totob12.github.io/things/inpainting-forward.html"><span class="material-symbols-outlined">format_paint</span><div class="dropdowncc">Paint</div></a>
  <a href="https://chill-radio.totob12.repl.co/"><span class="material-symbols-outlined">radio</span><div class="dropdowncc">Radio</div></a>
  <a href="https://totob12.github.io/things/games.html"><span class="material-symbols-outlined">sports_esports</span><div class="dropdowncc">Games</div></a>
  <a href="https://totob12.github.io/things/sites.html"><span class="material-symbols-outlined">handyman</span><div class="dropdowncc">Random</div></a>
  <a class="blanka" href=""></a>
  <a href="https://totob12.github.io/things/countdown.html"><span class="material-symbols-outlined">hourglass_empty</span><div class="dropdowncc">Countdown</div></a>
  <a href="https://totob12.github.io/things/feedback.html"><span class="material-symbols-outlined">alternate_email</span><div class="dropdowncc">Contact</div></a>
  </div>
</div>
    </ul>
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p><br>
            </div>
            <div id="menu">
                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            </div>
            <div id='gradient'></div>
            <div id="chatbox-in">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
            <form name="message" action="">
                <input name="usermsg" aria-label="Message" type="text" id="usermsg" placeholder="Type your message here..." />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
              <form name="url" action="">
                <input name="submiturl" type="submit" id="submiturl" value="Send" />
                <input name="userurl" aria-label="Url" type="url" id="userurl" placeholder="Paste an image url..."/>
            </form>
            <div id="notifbox">

            </div>
        </div>
        <!-- jquery.min.js = https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js -->
        <script type="text/javascript" src=jquery.min.js></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                function loadNotif() {
                    var oldscrollHeight = $("#notifbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "notif.html",
                        cache: false,
                        success: function (html) {
                            $("#notifbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#notifbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#notifbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
              
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });   
                    loadNotif()
                    $("#usermsg").val("");
                    return false;
                });
                $("#submiturl").click(function () {      
                    var clienturl = $("#userurl").val();
                   loadNotif()
                    $.post("posturl.php", { text: clienturl });
                    $("#userurl").val("");
                    return false;
                });

 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox-in")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox-in").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox-in")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox-in").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
                
                setInterval (loadLog, 500);
 
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
