<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

//----THIS IS MY ADDITIONAL APPLICATION VIEW, SHOWCASING THE USER SOME PS5 OFFICIAL ACCESSORIES---------------------

function createPeripheralsPage()
{
    //Get the Data we need for this page
    $tperipheralsarray = jsonLoadAllPeripherals();
    $tperipheralshtml = "";
    $tperipheralshtml .= renderperipheralsummary($tperipheralsarray);

    //Construct the Page
    $tcontent = <<<PAGE
    <article id="fixtures">
        {$tperipheralshtml}
    </article>
PAGE;
    return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

$tpagecontent = "";

$tid = $_REQUEST["fixid"] ?? -1;

//Handle our Requests and Search for Games
if (is_numeric($tid) && $tid > 0)
{
    $tpagecontent = createConsolePage($tid);
}
else
{
    $tpagecontent = createPeripheralsPage();
}

//Build up our Dynamic Content Items.
$tpagetitle = "Gaming peripherals";
$tpagelead  = "";
$tpagefooter = "";

//----BUILD OUR HTML PAGE----------------------------
//Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
//Return the Dynamic Page to the user.
$tpage->renderPage();
?>
