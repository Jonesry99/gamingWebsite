<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function createPage($pimgdir,$pcurrpage,$psortmode,$psortorder)
{  
    //Get the Presentation Layer content

    $tci = xmlLoadAll("data/xml/carousel-games.xml","PLCarouselImage","Image");
   
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
    
    //Render the HTML for our Table and our Pagination Controls
    $tsquadtable = renderGameTable($tsquad);
    $tpagination = renderPagination($_SERVER['PHP_SELF'],$tnopages,$pcurrpage);
    
    //Use the Presentation Layer to build the UI Elements
    $tcarousel   = renderUICarousel($tci,"{$pimgdir}/carousel");

        
$tcontent = <<<PAGE
        {$tcarousel}
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Games</li>
		</ul>
		<div class="row">
                <div class="panel" style="background-color: #f7f7f7">
                    <h2 style="padding: 10px">GameStation's Recommended Games</h2>
                    <p style="padding: 0px 0px 0px 20px; color: #cacacb"><b>Highest Ranked Game: </b>
                    <a href="http://localhost/game.php?id=1"><i>Fortnite Battle Royale</i></a></p>
                    <p style="padding: 0px 0px 0px 20px; color: #cacacb"><b>GameStation's Game Recommendation: </b>
                    <a href="http://localhost/game.php?id=3"><i>Uncharted: Legacy Of Thieves Collection</i></a></p>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-primary" style="background-color: #f7f7f8">
			<div class="panel-body">
				<h2>Ranked List of Games</h2>
				<p>{$tsquad->squadname}</p>
				<div id="squad-table">
			    {$tsquadtable}
                {$tpagination}
		        </div>
		    </div>
			</div>
		</div>
		<div class="row">
		    <div class="panel" style="background-color: #f7f7f7">
		        <h2 style="padding: 20px">Our Weekly Picks's</h2>
		        <div class="panel-body" style="background-color: #73c6e9; border-radius: 20px;">
                    <a href="http://localhost/game.php?id=1" style="font-size: 20px; color: #0c516c;">
                    Fortnite Battle Royale </a>
                    <p style="color: #f7f7f7">The free to play battle royale game that took the gaming community by storm! Build you way to the 
                    top and crown yourself with that ever-so-satisfying victory royale!</p>
                    <a href="http://localhost/game.php?id=5" style="font-size: 20px; color: #0c516c;">
                    FIFA 22</a>
                    <p style="color: #f7f7f7">The immersive, in-depth football simulation game made by EA Sports once 
                    again delivers for another year! Play it now and experience game modes like FIFA ULTIMATE TEAM,
                    PRO CLUBS or CAREER MODE</p>
                    <a href="http://localhost/game.php?id=7" style="font-size: 20px; color: #0c516c;">
                    NBA 2K22</a>
                    <p style="color: #f7f7f7">The 2K game that brings the NBA to your fingertips. With new features 
                    and animations implemented following from the previous game, NBA 2K22 is one of the hottest 
                    sporting games available!</p>
                </div>
            </div>
		</div>
PAGE;

return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();
$tcurrpage = $_REQUEST["page"] ?? 1;
$tcurrpage = is_numeric($tcurrpage) ? $tcurrpage: 1;
$tsortmode = $_REQUEST["sortmode"] ?? "";
$tsortorder = $_REQUEST["sortorder"] ?? "asc";

$tpagetitle = "Games";
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