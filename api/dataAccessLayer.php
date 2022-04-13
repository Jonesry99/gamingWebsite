<?php
//Include the Other Layers Class Definitions
require_once("objLogicLayer.php");
require_once("objOrientatedPresLayer.php");

//---------JSON HELPER FUNCTIONS-------------------------------------------------------

function jsonOne($pfile,$pid)
{
    $tsplfile = new SplFileObject($pfile);
    $tsplfile->seek($pid-1);
    return json_decode($tsplfile->current());
}

function jsonAll($pfile): array
{
    $tentries = file($pfile);
    $tarray = [];
    foreach($tentries as $tentry)
    {
        $tarray[] = json_decode($tentry);
    }
    return $tarray;
}

//---------JSON-DRIVEN OBJECT CREATION FUNCTIONS-----------------------------------------

function jsonLoadOneGame($pid) : BLLGame
{
    $tgame = new BLLGame();
    $tgame->fromArray(jsonOne("data/json/games.json",$pid));
    return $tgame;
}





function jsonloadConsole($pid): BLLConsole
{
    $tconsole = new BLLConsole();
    $tconsole->fromArray(jsonOne("data/json/consoles.json",$pid));
    return $tconsole;
}



//--------------MANY OBJECT IMPLEMENTATION--------------------------------------------------------

function jsonLoadAllReviews(): array
{
    $tarray = jsonAll("data/json/userReviews.json");
    return array_map(function($a){ $tc = new BLLUserReviews(); $tc->fromArray($a); return $tc; },$tarray);
}

function jsonLoadAllGame() : array
{
    $tarray = jsonAll("data/json/games.json");
    return array_map(function($a){ $tc = new BLLGame(); $tc->fromArray($a); return $tc; },$tarray);
}

function jsonLoadAllFixture(): array
{
    $tarray = jsonAll("data/json/consoles.json");
    return array_map(function($a){ $tc = new BLLConsole(); $tc->fromArray($a); return $tc; },$tarray);
}

function jsonLoadAllPeripherals(): array
{
    $tarray = jsonAll("data/json/consoles.json");
    return array_map(function($a){ $tc = new BLLConsole(); $tc->fromArray($a); return $tc; },$tarray);
}


//---------XML HELPER FUNCTIONS--------------------------------------------------------

function xmlLoadAll($pxmlfile,$pclassname,$parrayname): array
{
    $txmldata = simplexml_load_file($pxmlfile,$pclassname);
    $tarray = [];
    foreach($txmldata->{$parrayname} as $telement)
    {
        $tarray[] = $telement;
    }
    return $tarray;
}

?>