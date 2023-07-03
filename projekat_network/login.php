<?php
 // Cim treba nekako da koristimo sesiju mora ova f-ja da se pozove
  session_start(); // Ova f-ja treba  na pocetku (kao rva) da se pozove
  if(isset($_SESSION["id"]))
  {
    header("Location: index.php");
  }
  require_once "connection.php";
  $usernameError = "*";
  $passwordError = "*";
  $username = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // Korisnik je poslao username i passwrod i pokusava logovanke
    // izvrsavamo sql na siguran nacin
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);
  
  
    // vrsiimo razilicite validacije
    if(empty($username))
    {
      
      $usernameError = "Username cannnot be blank!";
    }

    // -------------------------------

    if(empty($password))
    {
      $passwordError = "Password cannot be blank!";
    }

    if ($usernameError == "*" &&  $passwordError == "*")
    {

      // ovde mozemo da pokusamo logujemo korisnika
      // ako se kredencijali za logovanje podudaraju
      $q = "SELECT * FROM `users` WHERE `username` = '$username';";
      $result = $conn->query($q);
      if($result->num_rows == 0)
      {
        $usernameError = "This username dossent exist";
      }
      else
      {
        // Postoji takav korisnik proveriti lozinke
        $row = $result->fetch_assoc();
        $dbPassword = $row['password']; // hesirana vrednost iz baze
        if(!password_verify($password, $dbPassword))
        {
          // Poklopili su se username ali loznka nije dobra
          $passwordError = "Wrong password, try again!";
        }
        else
        {
          // Dobri su i username i password, izvrsi logovanje
          $_SESSION["id"] = $row["id"];
          $_SESSION["username"] = $row["username"];
          header("Location: index.php");
        }
        
      }
    } 
    
    // ako je sve u redu loguj korisnika
    
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body class="followers">
<?php require_once "header.php"; ?>
<div class="container-fluid ">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6 py-3 white ">
  <form  class="form-group" action="#" method="post" autocomplete="off">
    <h1>Please Login</h1> 
    <div>
      <label for="username">Username</label>
      <input class="form-control type="text" name="username" id="username" value="<?php echo $username ?>">
      <span class="error"><?php echo $usernameError; ?></span>
    </div>
    <div>
      <label for="password">Password:</label>
      <input class="form-control" style="background-color: white;"type="password" name="password" id="password">
      <span class="error"><?php echo $passwordError; ?></span>

    </div>
    <div>
      <input class="btn btn-primary" type="submit" value="Login">
    </div>
    

  </form>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <div class="col-3"></div>
    </div>
  </div>
</body>
</html>
</body>
</html>