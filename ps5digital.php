<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function createConsolePage($pfixtureid)
{
    //Get the Data we need for this page
    $tconsole = jsonloadConsole($pfixtureid);
    $tconsole->report = file_get_contents("data/html/{$tconsole->report_href}");
    //Build the UI Components
    $tconsolehtml = renderConsoleDetails($tconsole,"Latest Fixture");

    //Construct the Page
    $tcontent = <<<PAGE
    <section class="row details" id="fixture-details">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Playstation 5 Digital &trade;</h3>
        </div>
        <div class="panel-body">
            {$tconsolehtml}
        </div>
    </div>
PAGE;
    return $tcontent;
}

function createPS5DigitalPage()
{
    //Get the Data we need for this page
    $tconsolearray = jsonLoadAllFixture();
    $tconsoleshtml = "";
    $tconsoleshtml .= renderConsoleSummary($tconsolearray);

    //Construct the Page
    $tcontent = <<<PAGE
    <article id="fixtures">
        {$tconsoleshtml}
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
    $tpagecontent = createPS5DigitalPage();
}

//Build up our Dynamic Content Items.
$tpagetitle = "Games Consoles";
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
