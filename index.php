<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------
function createPage()
{
    //Page-Specific Static Content
    $twelcome = "";
    
    //Content Classes via XML and JSON
    $tarticles = xmlLoadAll("data/xml/featured-games.xml","PLHomeArticle","Article");
    

        
    //Build the Articles
    $tarticlehtml = "";
    foreach($tarticles as $ta)
    {
        $tarticlehtml .= renderUIHomeArticle($ta);
    }
$tcontent = <<<PAGE
        <div class="row">
            {$twelcome}
		</div>
		
        <div class="row details">
            {$tarticlehtml}
		</div>
PAGE;
return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "Home Page";
$tpagelead  = "";
$tpagecontent = createPage();
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