<?php
 
session_start();
 
if(isset($_GET['logout'])){    
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
 
if(isset($_POST['Login'])){
    if($_POST['username'] != ""){
        $_SESSION['username'] = stripslashes(htmlspecialchars($_POST['username']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
function loginForm(){
    echo
  '
   <form action="index.php" class="box" id="loginbox" method="POST" class="h-screen bg-primary flex items-center justify-center text-lg px-6">
    
    <h4>Enter a Name</h4>
    <input type="text" name="username" id="username" placeholder="Username" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" /><br /><br />
    
    <button type="submit" name="Login" id="Login" class="bg-green-500 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enter Chat</button>
  </form>
  ';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
        <title>Community</title>
        <meta name="description" content="" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    </head>
    <body class="bg-dark">
    <?php
    if(!isset($_SESSION['username'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper" class="py-8 px-8 mx-0-auto bg-white rounded-xl shadow-2xl space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 md:px-5">
          <div class="icon font-bold "><b>Community</b></div>
            <div id="menu">
                <p class="welcome"><b><?php echo $_SESSION['username']; ?></b>&nbsp;&nbsp;<span class="status"></span></p>
            </div>
            <br />
            <div id="chatbox"  class="relative max-w-350px w-full bg-white bg-card-texture bg-no-repeat bg-top rounded shadow-md">
              <div class="mx-5">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
              </div>
            </div>
 
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Message..."/>&nbsp;
                <button type="button" id="submitmsg" class="bg-green-500 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline shadow-2xl"><i class="fa fa-paper-plane"></i></button>
                
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
 
            });
          
        </script>
    </body>
</html>
<?php
}
?>