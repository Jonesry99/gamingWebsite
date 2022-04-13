<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------


function createPage(){

        $tcontent = <<<PAGE
        <h1>An error has occured.</h1>
        <p><i><strong>Registering</strong></i> - that email is associated with another account already</p>
        <p><i><strong>Logging In</strong></i> - the email and password for that account were incorrect</p>
        <h3>Please return to the home page and try again.</h3>
        <p style="padding: 40px"><a href="index.php" class="btn btn-primary">Go Home</a></p>
PAGE;
return $tcontent;

}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "404: Error Page";
$tpagecontent = createPage();

//----BUILD OUR HTML PAGE----------------------------
//Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
$tpage->setDynamic2($tpagecontent);    
$tpage->renderPage();
?>