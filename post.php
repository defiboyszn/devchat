<?php
session_start();
if(isset($_SESSION['username'])){
    $text = $_POST['text'];
     
    $text_message = "<div class='rounded px-5 relative'><b class='text-green-500'>".$_SESSION['username']."</b><p class='text-gray-500 px-10'>".stripslashes(htmlspecialchars($text))."</p><b class='text-grey-500 font-sm absolute bottom-0 right-10'>".date("h:i:A")."</b></div><br>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>
