

<?php


$motivation = file(__DIR__ . '/text/motivation.txt');
$love = file(__DIR__ . '/text/love.txt');
$health = file(__DIR__ . '/text/health.txt');
$job = file(__DIR__ . '/text/job.txt');



$quotesM = $quotesL = $quotesH = $quotesJ = [];
$authorM = $authorL = $authorH = $authorJ = [];

$brQM = $brQL = $brQH = $brQJ = 0;
$brAM = $brAL = $brAH = $brAJ = 0;
for($i=0;$i<count($motivation);$i++)
{
  if($i%2==0)
  {
    // Motivation
    $quotesM[$brQM] = $motivation[$i];
    $brQM++;
    // Love
    $quotesL[$brQL] = $love[$i];
    $brQL++;
    // Health
    $quotesH[$brQH] = $health[$i];
    $brQH++;
    // Job
    $quotesJ[$brQJ] = $job[$i];
    $brQJ++;

   }
   else
   {
    // Motivation
    $authorM[$brAM] = $motivation[$i];
    $brAM++;
     // Love
    $authorL[$brAL] = $love[$i];
    $brAL++;
    // Health
    $authorH[$brAH] = $health[$i];
    $brAH++;
    // Job
    $authorJ[$brAJ] = $job[$i];
    $brAJ++;
   }
}


// Link parm
$m = 'Motivacija';
$l = 'Ljubav';
$h = 'Zdravlje';
$j = 'Posao';



// Printer

 
