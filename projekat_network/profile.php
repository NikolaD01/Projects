<?php
  require_once "connection.php";
  require_once "validation.php";
  session_start();
  if(!isset($_SESSION["id"]))
  {
    header("Location: index.php");
  }

  $id=$_SESSION["id"];
  $firstName = $lastName= $dob = $gender  = $image = "";
  $firstNameError = $lastNameError = $dobError = $genderError = $imageError = "";
  $sucMessage = "";
  $errMessage = "";
  $profileRow = profileExists($id, $conn);
  // ProfileRow = false , ako rofil ne postoji
  // ProfileRow = asocijativni niz ako profil postoji
 
 
  //echo "<img src='images/".$profileRow['image']."' alt='slika'>";


  if($profileRow !== false)
  {
    $firstName = $profileRow['first_name'];
    $lastName = $profileRow['last_name'];
    $dob = $profileRow['dob'];
    $gender = $profileRow['gender'];
    $image = $profileRow['image'];
  }
  
  $default = array('boy','girl','other');


  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $firstName = $conn->real_escape_string($_POST["first_name"]);
    $lastName = $conn->real_escape_string($_POST["last_name"]);
    $gender = $conn->real_escape_string($_POST["gender"]);
    $dob = $conn->real_escape_string($_POST["dob"]);
   
    if(strlen($conn->real_escape_string($_POST['image'])) > 0)
    {
      $image = $conn->real_escape_string($_POST['image']);
    }
    elseif(strlen($image) > 0)
    {
      if(!contains($image, $default))
      {
        $image = $image;
      }
      else
      {
        $image = defaultImage($image, $gender);
      }
      
    }
    else
    {
      $image = defaultImage($image, $gender);
    }
    

    $firstNameError = nameValidation($firstName);
    $lastNameError = nameValidation($lastName);
    $genderError = genderValidation($gender);
    $dobError = dobValidation($dob);
    $imageError = imageValidation($image);
   
  
    
    if($firstNameError == "" && $lastNameError == "" && $genderError == ""
     && $dobError == "" )
     {
      $q = "";
      if($profileRow === false)
      {
       
        $q = "INSERT INTO `profiles`
        (`first_name`, `last_name`, `gender`, `dob`, `id_user`,`image`)
         VALUE
        ('$firstName', '$lastName' , '$gender', '$dob', $id, '$image');
        ";
      }
      else
      {
     
        $q = "UPDATE `profiles`
        SET `first_name` = '$firstName' , 
        `last_name` = '$lastName' , 
        `gender` = '$gender',  
        `dob` = '$dob',
        `image` = '$image'
        WHERE `id_user` = $id;";
      }
       // VALUE  jedan red , VALUES vise redova
       
       if($conn->query($q))
       {
         // uspesno kreiran profil
         if($profileRow !== false)
         {
          $sucMessage = "You have edited your profile";
         }
         else
         {
          $sucMessage = "You have created your profile";
         }
         
       }
       else
       {
          // desila se greska u u pitu
          $errMessage = "Error creating profile: " . $conn->error;
       }
     }
  }
  
 
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body class="profile">
<?php require_once "header.php"; ?>
<div class="container-fluid ">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6 py-3 white ">
        <div class="success">
          <?php echo $sucMessage; ?>
        </div>
        <div class="error">
          <?php echo $errMessage; ?>
        </div>
        <h1>Please fill the profile details</h1> 
        <form class="form" action="#" method="post" autocomplete="off">
            <div>
              <label for="first_name">First name:</label>
              <input class="form-control"type="text" name="first_name" id="first_name" value="<?php echo $firstName ?>">
              <span class="error">*<?php echo $firstNameError ?></span>
            </div>
            <div>
              <label for="last_name">Last name:</label>
              <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $lastName ?>">
              <span class="error">*<?php echo $lastNameError ?></span>
            </div>
            <div>
              <label for="gender">Gender:</label>
              <input  type="radio" name="gender" id="m" value="m" <?php if($gender == "m"){echo "checked";}?>> Male
              <input  type="radio" name="gender" id="f" value="f" <?php if($gender == "f"){echo "checked";}?>> Female
              <input  type="radio" name="gender" id="o" value="o" <?php if($gender == "o" || $gender == ""){echo "checked";}?>> Other
              <span class="error"><?php echo $genderError; ?></span>
            </div>
            <div>
              <label for="dob">Date of birh:</label>
              <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $dob ;?>">
              <span class="error"><?php echo $dobError; ?></span>
            </div>
            <div>
              <!-- IMAGE IMAGE IMAGE IMAGE IMAGE IMAGE IMAGE IMAGE IMAGE -->
              <label for="image">Select image:</label>
              <input class="form-control" type="file" id="image" name="image" accept="image/*">
              <span class="error"><?php echo $imageError; ?></span>
            </div>
            <div>
              <input class="form-control btn btn-primary" style="margin-top: 10px;" type="submit" value="<?php echo ($profileRow === false) ? 'Create profile' : 'Edit profile' ?>">
            </div>
        </form>
        <div>
          Go back to <a href="index.php">Home page</a>.
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
        <div class="col-3"></div>
    </div>
  </div>
</body>
</html>