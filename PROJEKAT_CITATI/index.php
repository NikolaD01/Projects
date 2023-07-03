  
  
<?php require('components/header.php'); ?>

<!-- -----------CAROUSE--------------------------- -->

<?php require('components/carousel.php'); ?>
<div class="container-fluid">
  <div class="row">
      <div class="col-1"></div>
      <div class="carousel slide col-10   " data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="3000">
            <?php echo "<img src='images/image${imgOne}.jpg' class='d-block w-100' alt='image$imgOne'>"; ?>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <?php echo "<img src='images/image$imgTwo.jpg' class='d-block w-100'  alt='image$imgTwo'>"; ?>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <?php echo "<img src='images/image$imgThree.jpg' class='d-block w-100' 'alt='image$imgThree'>"; ?>
          </div>
        </div>
      </div>
      <div class=" col-1 "></div>
  </div>
</div>

<!-- -----------MAIN--------------------------- -->

<?php require('text.php'); ?>

<nav class="navbar navbar-expand-lg  bg-body-tertiary ">
  <div class="container-fluid">
    <div class="d-flex justify-content-center text-center" >
      <button class="navbar-toggler "  type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav" >
      <ul class="navbar-nav d-flex justify-content-center text-center">
        <li class="nav-item ">
          <?php echo '<a  class="nav-link" href="index.php?link='. $m .'">Motivacija</a>'; ?>
        </li>
        <li class="nav-item">
          <?php echo '<a class="nav-link" href="index.php?link='. $l .'">Ljubav</a>';?>
        </li>
        <li class="nav-item">
          <?php echo '<a class="nav-link" href="index.php?link='. $h .'">Zdravlje</a>';?>
        </li>
        <li class="nav-item">
          <?php echo '<a class="nav-link" href="index.php?link='. $j .'">Posao</a>';?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<hr>
<main role="main container-fluid " class="inner cover">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8 text-center">
      <?php
      if(isset($_GET["link"]) && trim($_GET["link"]) == 'Motivacija')
      {
        $ran = rand(0,10);
        echo "<h1 class='cover-heading'>$quotesM[$ran]</h1>";
        echo "<p class='lead'>$authorM[$ran]</p>";
        
      }
      elseif(isset($_GET["link"]) && trim($_GET["link"]) == 'Ljubav')
      {
        $ran = rand(0,10);
        echo "<h1 class='cover-heading'>$quotesL[$ran]</h1>";
        echo "<p class='lead'>$authorL[$ran]</p>";
      }
      elseif(isset($_GET["link"]) && trim($_GET["link"]) == 'Zdravlje')
      {
        $ran = rand(0,10);
        echo "<h1 class='cover-heading'>$quotesH[$ran]</h1>";
        echo "<p class='lead'>$authorH[$ran]</p>";
      }
      elseif(isset($_GET["link"]) && trim($_GET["link"]) == 'Posao')
      {
        $ran = rand(0,10);
        echo "<h1 class='cover-heading'>$quotesJ[$ran]</h1>";
        echo "<p class='lead'>$authorJ[$ran]</p>";
      }
      else
      {
        $ran = rand(0,3);
        $br = rand(0,10);
        $ranArray= array(
          $arrayM = array(
            $quotesM,
            $authorM
          ),
          $arrayL = array(
            $quotesL,
            $authorL
          ),
          $arrayH = array(
            $quotesH,
            $authorH
          ),
          $arrayJ = array(
            $quotesJ,
            $authorJ
          )
        );
        echo "<h1 class='cover-heading'>" .$ranArray[$ran][0][$br]. "</h1>";
        echo "<p class='lead'>" .$ranArray[$ran][1][$br]. "</p>";
      }
     
      ?>
    </div>
    <div class="col-2"></div>
  </div>
</main>


<?php  require('components/footer.php'); ?>