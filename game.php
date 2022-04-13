<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pgames,$tuserReviews)
{
    $tgameprofile = "";
    foreach($pgames as $tp)
        {
            $tgameprofile .= renderGameOverview($tp);
        }
    $tuserSubmittedReviews = "";
    foreach ($tuserReviews as $ur)
        {
            $tuserSubmittedReviews .= renderUserReviews($ur);
        }

    $tcontent = <<<PAGE
      {$tgameprofile}
      {$tuserSubmittedReviews}
PAGE;
    return $tcontent;
}


// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();


$tgames = [];
$tuserReviews = [];
$tname = $_REQUEST["name"] ?? "";
$trankingNo = $_REQUEST["rankingNo"] ?? -1;
$tid = $_REQUEST["id"] ?? -1;

//Handle our Requests and Search for Games using different methods
if (is_numeric($tid) && $tid > 0) 
{
    $tgame = jsonLoadOneGame($tid);
    $tgames[] = $tgame;
} 
else if (!empty($tname)) 
{
    //Filter the name
    $tname = appFormProcessData($tname);
    $tgamelist = jsonLoadAllGame();
    foreach ($tgamelist as $tp)
    {
        if (strtolower($tp->name) === strtolower($tname))
        {
            $tgames[] = $tp;
        }
    }
}
else if($trankingNo > 0)
{
    $tgamelist = jsonLoadAllGame();
    foreach ($tgamelist as $tp)
    {
        if ($tp->rankingNo === $trankingNo)
        {
            $tgames[] = $tp;
            break;
        }
    }
}

if (!empty($tname))
{
    //Filter the name
    $tname = appFormProcessData($tname);
    $tgamelist = jsonLoadAllReviews();
    foreach ($tuserReviews as $ur)
    {
        if (strtolower($ur->name) === strtolower($tname))
        {
            $tuserReviews[] = $ur;
        }
    }
}

//Page Decision Logic - Have we found a game?  
//Doesn't matter the route of finding them
if (count($tgames)===0) 
{
    appGoToError();
} 
else
{
    //We've found our game
    $tpagecontent = createPage($tgames,$tuserReviews);
    $tpagetitle = "Game Page";

    // ----BUILD OUR HTML PAGE----------------------------
    // Create an instance of our Page class
    $tpage = new MasterPage($tpagetitle);
    $tpage->setDynamic2($tpagecontent);
    $tpage->renderPage();
}
?>