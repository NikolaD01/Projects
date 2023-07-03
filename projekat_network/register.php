<?php
  // Nedozovoljavamo pristup ovoj stranici logovanim korisnicma
  session_start();
  if(isset($_SESSION["id"]))
  {
    header("Location: index.php");
  }
  require_once "connection.php";
  require_once "validation.php";

  $usernameError = "";
  $passwordError = "";
  $retypeError = "";
  $username = "";
  $password = "";
  $retype = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // Forma je poslata treba pokupiti vrednosti iz polja

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $retype = $conn->real_escape_string($_POST['retype']);

    //var_dump($username);
    //var_dump($password);
    //var_dump($retype);

    // 1 izvrsiti validaciju za username
    $usernameError = usernameValidation($username, $conn);
    // 2 izvrsiti validaciju za passwrod
    $passwordError = passwordValidation($password);

    $retypeError = passwordValidation($retype);
    // 3 izvristi validaciju za retype
    if($password !== $retype)
    {
      $retype = "You must enter two same passwords";
    }
    // 4.1 ako su sva polja validna, onda treba dodati novog korisnika
    // (Treba izvristi inser upit nad tabelom `users`)
    if ($usernameError == "" && $passwordError == "" && $retypeError == "")
    {
      // lozinka treba da se sifruje

      $hash = password_hash($password, PASSWORD_DEFAULT);
      $q = "INSERT INTO `users` (`username`,`password`)
      VALUES
      ('$username','$hash');";

      if($conn->query($q))
      {
        // Kreirali smo novog korisnika, vodi ga na stranicu za logovanje 
        header("Location: index.php?p=ok");
      }
      else
      {
        header("Location: error.php?" . http_build_query(['m' => "Greska kod kreiranja korisnika"]));
      }
    }

    
    // 4.2 ako posotji neko polje koje nije validno, ne raditi upit
    // Nego vratiti korsnika na stranicu i prikazati poruke
    if($usernameError !== "")
    {

    }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Register new user</title>
</head>
<body class="register">
<?php require_once "header.php"; ?>

  <div class="container-fluid ">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6 py-3 white ">
        
        <h1>Register to our site</h1>
        <form class="form-group" action="register.php" method="POST"> <!-- Skupljamo podatke -->
          <div>
            <label for="username">Username:</label>
            <input class="form-control" type="text" name="username" id="username" value="<?php echo $username ?>">
            <span class="error">*<?php echo $usernameError ?></span>
          </div>
          <div>
            <label for="username">Password:</label>
            <input class="form-control" type="password" name="password" id="password" value="">
            <span class="error">*<?php echo $passwordError ?></span>

          </div>
          <div>
            <label for="retype">Retype password:</label>
            <input class="form-control"  type="password" name="retype" id="retype" value="">
            <span class="error">*<?php echo $retypeError ?></span>
          </div>
          <div>
            <input class="btn btn-primary"type="submit" value="Register me!">
          </div>
        </form>
      </div>
      <div class="col-3"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>
</html>