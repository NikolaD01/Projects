<?php
  session_start();
  require_once "connection.php";
  if(empty($_SESSION['id']))
  {
    header("Location: index.php");
  }

  $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Members of Social Network</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body class="followers">
<?php require_once "header.php"; ?>
<div class="container-fluid ">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6 py-3 white ">
  <h1>See the members from our site</h1>
  <?php
  $q = "SELECT `u`.`id`, `u`.`username`,`p`.`image`,
        CONCAT(`p`.`first_name`,' ',  `p`.`last_name`) AS `full_name`
        FROM `users` AS `u` 
        LEFT JOIN `profiles` AS `p`
        ON `u`.`id` = `p`.`id_user`
        WHERE `u`.`id` != $id
        ORDER BY `full_name` ;
        ";
  $reuslt = $conn->query($q);
  if($reuslt->num_rows==0) // num rows je polje
  {
    ?>
      <div class="error"> No other users in database :(</div>
    <?php
  }
  else
  {
    echo "<table class='table table-sm'>";
    echo "<tr ><th  >Name</th><th>Action</th></tr>";
    while($row= $reuslt->fetch_assoc())
    {
      echo "<tr ><td>";
        if($row["full_name"] !== NULL)
        {
          echo $row['full_name'];
          ?>
          <img src="images/<?php  echo $row['image'];?>">
         <?php
        }
        else
        {
          echo $row['username'];
        }
        echo "</td><td>";
          // ovde cemo linkove za pracenje korisnika
        $friendId = $row['id'];
        echo "<a href='follow.php?friend_id=$friendId' class='btn btn-primary'>Follow</a>";
        echo "&nbsp";
        echo "<a href='unfollow.php?friend_id=$friendId' class='btn btn-danger'>Unfollow</a>";
        echo "</td></tr>";
    }
    echo "</table>";
  }
  ?>
  Go back to <a href="index.php">Home page</a>
  </div>
      <div class="col-3"></div>
    </div>
  </div>
</body>
</html>