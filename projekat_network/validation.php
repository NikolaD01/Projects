<?php

function usernameValidation($u, $c)
{

  $query = "SELECT * FROM `users` WHERE `username` = '$u';";
  $result = $c->query($query);

  if(empty($u))
  {
    return "Username cannot be blank";
  }
  elseif(preg_match('/\s/', $u)) // ako sadrzi space  \s
  {
    return "Username cannnot contain space";
  }
  elseif(strlen($u) < 5 || strlen($u) > 25)
  {
    return "Username must between 5 and 25 characters";
  }
  elseif($result->num_rows > 0)
  {
    return "Usrename is reserved, please choose another one";   
  }
  else
  {
    return "";
  }
}


function passwordValidation($p)
{
  if(empty($p))
  {
    return "Password cannot be blank";
  }
  elseif(preg_match('/\s/', $p)) // ako sadrzi space  \s
  {
    return "Password cannnot contain space";
  }
  elseif(strlen($p) < 5 || strlen($p) > 50)
  {
    return "Password must between 5 and 50 characters";
  }
  else
  {
    return "";
  }
}

function nameValidation($n)
{
  $n = str_replace(' ', "", $n);
  if(empty($n))
  {
    return "Name cannot be empty";
  }
  elseif(strlen($n) > 50)
  {
    return "nName canot contain more then 50 characters";
  }
  elseif(ctype_alpha($n) == false)
  {
    return "must contain only letters";
  }
  /*elseif(preg_match('/[ŠšĐđŽžČčĆć]/m', $n) == true && ctype_digit($n) == true
  && ctype_punct($n) == true)
  {
    return "Name must contain only letters";
  }*/
  else
  {
    return "";
  }
}

function genderValidation($g)
{
  if($g != "m" && $g != "f" && $g != "o" )
  {
    return "Unknown Gender";
  }
  else
  {
    return "";
  }
}

function dobValidation($date)
{
    if (empty($date))
    {
        return "";
    }
    if ( $date < '1900-01-01')
    {
        return "Date not valid";
    }
    else
    {
        return "";
    }
}

function profileExists($id, $conn)
{
  $q = "SELECT * FROM `profiles` WHERE `id_user` = $id";
  $result = $conn->query($q);
  if ($result->num_rows==0)
  {
    return false;
  }
  else
  {
    $row = $result->fetch_assoc();
    return $row;
  }

}

function imageValidation($image)
{
  $allowedExt = array('gif','png','jpg','jpeg');
  $fileExt = pathinfo($image, PATHINFO_EXTENSION);
  if(!in_array($fileExt, $allowedExt))
  {
    return "Invalid extenstion";
  }
}

function defaultImage($image, $gender)
{
    if($gender == "m")
    {
      return $image = "boy.png";
    }
    elseif($gender == "f")
    {
      return $image = "girl.png";
    }
      else
    { 
      return $image = "other.png";
    }
}

function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}