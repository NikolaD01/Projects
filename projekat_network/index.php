<?php 
session_start();
require_once "connection.php";
require_once "validation.php";


$poruka = "";
if(isset($_GET["p"]) && $_GET["p"] == "ok")
{
  $poruka = "<div class='alert alert-primary alert-dismissible fade show' role='alert'>Successful register! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

$username = "mr. Anonymus";
if(isset($_SESSION["username"]))
{
  $username = $_SESSION["username"];
  $id = $_SESSION["id"];
  $row = profileExists($id, $conn);
  $m = "";
  if($row === false)
  {
    // nema profil
    $m = "Create";
  }
  else
  {
    // Logovani korisinik ima profil
    $m = "Edit";
    $username = $row['first_name'] . ' ' . $row['last_name'];
  }
       
}
?>
<!DOCTYPE html>
<html lang="en">
<head class="index">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Network</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel='stylesheet' href='style.css' version='1'>


  <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<?php require_once "header.php"; ?>


<body class="index">
  <div class="container-fluid ">
    <div class="row row-no-gutters">
      <div class="col-xs-6 col-md-6 " ></div>
      <div class="col-xs-6 col-md-5 white">
        <div class="success"> <!-- zameniti nekim elemntom iz bootstrapa -->
          <?php echo $poruka; ?>
        </div >
        <h1 class="py-3" >Welcome, <?php echo $username ?>, to our City Network!</h1>  
        <?php if (!isset($_SESSION["username"])) { ?>
        <p>Never been here before? <a href="register.php">Register here</a>!</p>
        <p>U are cool  already ? <a href="login.php">Login here</a>!</p></div>
        <?php } else { ?>
        <p><?php echo $m ?> a <a href="profile.php">profile</a>.</p>
        <p>See other cool people <a href="followers.php">Here</a>.</p>
        <p><a href="logout.php">Logout</a> from our site. :(</p>
        <?php } ?>
      </div>
    </div>
    <div class="col-xs-6 col-md-1" ></div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>