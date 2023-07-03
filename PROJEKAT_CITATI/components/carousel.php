<?php
$imgOne = rand(1,10);
$imgTwo = rand(1,10);
$imgThree = rand(1,10);


if($imgTwo == $imgOne)
{
  if($imgOne == 10)
  {
    $imgTwo-=1;
  }
  else
  {
    $imgTwo+=1;
  }
}

if($imgThree == $imgOne)
{
  if($imgOne == 10)
  {
    $imgThree-=1;
    if($imgThree == $imgTwo)
    {
      $imgThree-=1;
    }
  } 
  else
  {
    $imgThree+=1;
    if($imgThree == $imgTwo)
    {
      $imgThree+=1;
      if($imgThree > 10)
      {
        $imgThree-=3;
      }
    }
  }
}
elseif($imgThree == $imgTwo)
{   
  if($imgTwo == 10)
  {
    $imgThree-=1;
    if($imgThree == $imgOne)
    {
      $imgThree-=1;
    }
  }
  else
  {
    $imgThree+=1;
    if($imgThree == $imgOne)
    {
      $imgThree+=1;
      if($imgThree > 10)
      {
        $imgThree-=3;
      }
    }
  }
}

?>