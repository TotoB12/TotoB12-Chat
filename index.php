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
        if($_POST['name'] != "a15900000a"){
            if($_POST['name'] != "a15900000A!!"){
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
    <p>Welcome to TotoB12 Chat</p>
    <img src=logo.jpeg alt="logo" height="257" width="389">
    <h3>Please enter your name to continue!</h3>
    <br>
    <h4>This server is under constant moderation.</h4>
    <h4>It\'s improper usage will result in a ban.</h4>
    <h4>Every message is permanent.</h4>
    <h4>To contact Admin, please mention @admin in your message.</h4>
    <h4>By using this service, you accept it\'s <a href = "terms.html" target = "_self">Terms Of Use.</a></h4>
    <form action="index.php" method="post">
      <label for="name">Name →</label>
      <input type="text" name="name" id="name" />
      <input type="submit" name="enter" id="enter" value="Enter" />
      <br>
    </form>
  </div>';
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
     
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="favicon.ico">
      
        <title>TotoB12 Chat</title>
        <meta name="description" content="TotoB12 Chat" />
        <link rel="stylesheet" href="style.css" />
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
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
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
