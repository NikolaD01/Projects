<?php 
require_once "connection.php";
require_once "validation.php";

if(isset($_SESSION["id"]))
  {
    $id= $_SESSION["id"];
    $profileRow = profileExists($id, $conn);
    if($profileRow)
    {
      $image = $profileRow['image'];
      if($profileRow['first_name'])
      {
        $name = $profileRow['first_name'] . " " . $profileRow['last_name'];
      }
      else
      {
        $name = $profileRow['username'];
      }
    }
    else
    {
      $image = "other.png";
      $name = $_SESSION['username'];
    }
    
    
  }


?>

<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">City Network</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
          <?php if (!isset($_SESSION["username"])) { ?>
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          <a class="nav-link" href="register.php">Register</a>
          <a class="nav-link" href="login.php">Login</a>
          <?php } else { ?>
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="profile.php">Profile</a>
          <a class="nav-link" href="followers.php">Connections</a>
          <a class="nav-link" href="logout.php">Logout</a>
          <a class="nav-link name"><?php echo $name ?></a>
          <img src="images/<?php  echo $image?>">
          <?php } ?>
      </div>
    </div>
  </div>
</nav>