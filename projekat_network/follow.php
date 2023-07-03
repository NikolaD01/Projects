<?php
   // Onaj ko salje zahtev: Logovan korisnik
    // Onaj kome je upucen zahtev: Dohvatamo iz URL-a
    session_start();
    if(empty($_SESSION["id"]))
    {
        header("Location: index.php");
    }
    $id = $_SESSION["id"];
    require_once "connection.php";    
    if(empty($_GET["friend_id"]))
    {
        header("Location: index.php");
    }
    $friendId = $conn->real_escape_string($_GET["friend_id"]);   
     $q = "SELECT * FROM `followers`
            WHERE `id_sender` = $id
            AND `id_receiver` = $friendId";
    $result = $conn->query($q);
    if($result->num_rows == 0)
    {
        $upit = "INSERT INTO `followers`(`id_sender`, `id_receiver`)
                VALUE ($id, $friendId)";
        $result1 = $conn->query($upit);
    }
    header("Location: followers.php");

?>