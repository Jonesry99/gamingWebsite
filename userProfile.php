<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function createPage($pimgdir,$pcurrpage,$psortmode,$psortorder)
{
    //Get the Presentation Layer content

    $tsquad = new BLLSquad();
    $tsquad->squadname = "Highest Ranking Games";
    $tsquad->squadlist = jsonLoadAllGame();

    //We need to sort the squad using our custom class-based sort function
    $tsortfunc = "";
    if($psortmode == "rankingNo")
        $tsortfunc = "squadsortbyno";
    else if($psortmode == "name")
        $tsortfunc = "squadsortbyname";

    //Only sort the array if we have a valid function name
    if(!empty($tsortfunc))
        usort($tsquad->squadlist,$tsortfunc);


    //The pagination working out how many elements we need and
    $tnoitems  = sizeof($tsquad->squadlist);
    $tperpage  = 5;
    $tnopages  = ceil($tnoitems/$tperpage);

    //Create a Pagniated Array based on the number of items and what page we want.
    $tfiltersquad = appPaginateArray($tsquad->squadlist,$pcurrpage,$tperpage);
    $tsquad->squadlist = $tfiltersquad;


    //Use the Presentation Layer to build the UI Elements
    $tmyname = $_SESSION["myuser"] ?? "";

    $profilePref = file_get_contents('data/json/profilePreferences.json');
    $json = json_decode($profilePref);

    $tcontent = <<<PAGE
        <article class="row marketing" style="padding: 10px">
		<div class="media-left">
		    <h2 style="float: right">My Public Profile</h2>
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" width="256"/>
            <a class="btn btn-info" style="width: 256px; background-color: #a055ec; border-width: 2px; 
            border-color: #FFF" href="">Edit Profile Picture</a>
        </div>
        <div class="media-body" style="padding: 20px">
            <h2>Profile Details:</h2>
            <p>Account Name: $tmyname</p>
	           <div class="col-xs-3">
		            <select class="form-register" style="width: 200px; float: left">
		                <option selected disabled>Favourite Game</option>
		                <option>Fortnite Battle Royale</option>
		                <option>F1 2021</option>
		                <option>Uncharted: Legacy of Thieves</option>
		                <option>Horizon Forbidden West</option>
		                <option>FIFA 22</option>
		                <option>Ratchet and Clank Rift Apart</option>
		                <option>NBA 2K22</option>
		                <option>Madden NFL 22</option>
		                <option>Subnautica: Below Zero</option>
		                <option>Farming Simulator 22</option>
		            </select>
		            <select class="form-register" style="width: 200px; float: left">
		                <option selected disabled>Favourite Game Genre</option>
		                <option>Battle Royale</option>
		                <option>Action/Adventure</option>
		                <option>Sport</option>
		                <option>Racing</option>
		                <option>RPG</option>
		            </select>
		            <select class="form-register" style="width: 200px; float: left">
		                <option selected disabled>Favourite Console</option>
		                <option>PS5&trade;</option>
		                <option>PS5&trade; Digital</option>
		            </select>
            
        </div>
        
        </article>
PAGE;

    return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();
if (!isset($_SESSION['myuser']) || empty($_SESSION['myuser'])) {
    die('You must be logged in to visit the profile page!');
}
$tmyname = $_REQUEST["myname"] ?? "";
$tcurrpage = $_REQUEST["page"] ?? 1;
$tcurrpage = is_numeric($tcurrpage) ? $tcurrpage: 1;
$tsortmode = $_REQUEST["sortmode"] ?? "";
$tsortorder = $_REQUEST["sortorder"] ?? "asc";

$tpagetitle = "Profile Page";
$tpage = new MasterPage($tpagetitle);
$timgdir = $tpage->getPage()->getDirImages();

//Build up our Dynamic Content Items.
$tpagelead  = "";
$tpagecontent = createPage($timgdir,$tcurrpage,$tsortmode,$tsortorder);
$tpagefooter = "";

//----BUILD OUR HTML PAGE----------------------------
//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
//Return the Dynamic Page to the user.
$tpage->renderPage();
?>