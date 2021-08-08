<?php
 function profile(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Profile</title>
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
</head>
<body>
<div class="signuph">
      <?php
        session_start()
      ?>
		<p class="text-grey-500"><br><b>Welcome </b><?php echo $_SESSION["username"] ?></p>
</div>
<div class="cont">
  <button class="group bg-red-500 hover:bg-red-200 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline shadow-2xl"><a href="index.php">Group Chat</a></button>
</div>
</body>
</html>
<?php
 }
 profile();
?>