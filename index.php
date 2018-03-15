<?php
declare(strict_types=1);
include('class/Tranches.php');
include('class/Investor.php');
include('class/Application.php');


//Creating application instance
$app=new Application;

$loan=$app->createLoan();
$investmentResult=$app->createInvestors($loan);
$fp = fopen('investmentResult.json', 'w');
fwrite($fp,$investmentResult);
fclose($fp);
echo 'INPUT1:<br/>loan.json(Found at the root of the project,which contains the json object of all the traches which we wants to create)<p>';
echo 'INPUT2:<br/>Investor.json(Found at the root of the project,which contains the json object of all the Investors along with their detail who wants tro invest in the above created traches)<p>';
echo 'RESULT:<br/>Please Find the Investment Result in the investmentResult.json file placed at the root of the project';
?>