<?php
require_once ("objLogicLayer.php");
require_once ("objOrientatedPresLayer.php");

//===========RENDER BUSINESS LOGIC OBJECTS=======================================================================


// ----------SQUAD/PLAYER RENDERING---------------------------------------
function renderGameTable(BLLSquad $pgames)
{
    $trowdata = "";
    foreach ($pgames->squadlist as $tp) {
        $tformat = $pgames->captainindex == $tp->rankingNo ? " class=\"success\"" : "";
        if (empty($tformat))
            $tformat = $pgames->stargameindex == $tp->rankingNo ? " class=\"danger\"" : "";
            $trowdata .= <<<ROW
<tr{$tformat}>
   <td>{$tp->rankingNo}</td>
   <td>{$tp->genre}</td>
   <td>{$tp->gameName}</td>
   <td>{$tp->ageRating}</td>
   <td>{$tp->gameScore}</td>
   <td><a class="btn btn-info" href="game.php?id={$tp->id}">More...</a></td>
</tr>
ROW;
    }
    $ttable = <<<TABLE
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th id="sort-rank">Rank #</th>
			<th id="sort-genre">Game Genre</th>
			<th id="sort-name">Name</th>
			<th id="sort-age">Age Rating</th>
			<th id="sort-score">Recommendation Score</th>
		</tr>
	</thead>
	<tbody>
	{$trowdata}
	</tbody>
</table>
TABLE;
	return $ttable;
}


function renderGameOverview(BLLGame $pp)
{
//    $ur = BLLUserReviews::
    $timgref = "img/games/{$pp->rankingNo}.jpg";
    $timg = $timgref;
    if ($pp->gameName == "Fortnite Battle Royale")  // --- Fortnite only has one purchase option, through the PSN Store
    {
    $toverview = <<<OV
    <article class="row marketing" style="padding: 10px">
        <h2>Game Information</h2>
        <div class="media-left">
            <img src="$timg" width="256"/>
            <a class="btn btn-info" style="width: 256px; background-color: #a055ec; border-width: 2px; 
            border-color: #FFF" href={$pp->gameBuy1}>PlayStation.Store</a>
        </div>
        <div class="media-body" style="padding: 10px">
            <div class="well">
                <h1>{$pp->gameName}
            </div>
            <h4>GameStation Ranking: {$pp->rankingNo}</h4>
            <h4>Game Genre: {$pp->genre}</h4>
            <h4>Age Rating: {$pp->ageRating}</h4>
            <h4>Game Price: £{$pp->gamePrice}</h4>
            <h4>GameStation Score: {$pp->gameScore}</h4>
        </div>
        <div class="media-extra">
            <p style="padding: 20px">{$pp->gameSummary}</p>
            <h1>What We Think:</h1>
            <p style="padding: 20px">{$pp->gameStationReview}</p>
            <p style="padding: 20px"><i>GameStation Score: {$pp->gameScore}</i></p>
           <h1>External Reviews</h1>
           <h3><u>Review 1:</u></h3>
           <div class="video-container">
           <iframe  width="900" height="506" src={$pp->gameVideo1} title="YouTube video game"
            frameborder="1px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
             allowfullscreen></iframe>
           </div>
           <h3><u>Review 2:</u></h3>
           <div class="video-container">
           <iframe  width="900" height="506" src={$pp->gameVideo2} title="YouTube video game"
            frameborder="1px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
             allowfullscreen></iframe>
           </div>
           <h3><u>Review 3:</u></h3>
           <div class="video-container">
           <iframe  width="900" height="506" src={$pp->gameVideo3} title="YouTube video game"
            frameborder="1px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
             allowfullscreen></iframe>
           </div>
        </div>
        <h1 style="padding: 20px">User Reviews:</h1>
        
    </article>
OV;

    }
    else {
        $toverview = <<<OV
    <article class="row marketing" style="padding: 10px">
        <h2>Game Information</h2>
        <div class="media-left">
            <img src="$timg" width="256"/>
            <a class="btn btn-info" style="width: 256px; background-color: #a055ec; border-width: 2px; 
            border-color: #FFF" href={$pp->gameBuy1}>PlayStation.Store</a>
            <a class="btn btn-info" style="width: 256px; background-color: #a055ec; border-width: 2px; 
            border-color: #FFF" href={$pp->gameBuy2}>GAME</a>
            <a class="btn btn-info" style="width: 256px; background-color: #a055ec; border-width: 2px; 
            border-color: #FFF" href={$pp->gameBuy3}>AMAZON</a>
        </div>
        <div class="media-body" style="padding: 10px">
            <div class="well">
                <h1>{$pp->gameName}
            </div>
            <h4>GameStation Ranking: {$pp->rankingNo}</h4>
            <h4>Game Genre: {$pp->genre}</h4>
            <h4>Age Rating: {$pp->ageRating}</h4>
            <h4>Game Price: £{$pp->gamePrice}</h4>
            <h4>GameStation Score: {$pp->gameScore}</h4>
        </div>
        <div class="media-extra">
           <p style="padding: 20px">{$pp->gameSummary}</p>
           <h1>What We Think:</h1>
            <p style="padding: 20px">{$pp->gameStationReview}</p>
            <p style="padding: 20px"><i>GameStation Score: {$pp->gameScore}</i></p>
           <h1>External Reviews</h1>
           <h3><u>Review 1:</u></h3>
           <div class="video-container">
           <iframe  width="900" height="506" src={$pp->gameVideo1} title="YouTube video game"
            frameborder="1px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
             allowfullscreen></iframe>
           </div>
           <h3><u>Review 2:</u></h3>
           <div class="video-container">
           <iframe  width="900" height="506" src={$pp->gameVideo2} title="YouTube video game"
            frameborder="1px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
             allowfullscreen></iframe>
           </div>
           <h3><u>Review 3:</u></h3>
           <div class="video-container">
           <iframe  width="900" height="506" src={$pp->gameVideo3} title="YouTube video game"
            frameborder="1px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
             allowfullscreen></iframe>
           </div>
        </div>
    </article>
OV;

    }
    return $toverview;
}

function renderUserReviews(BLLUserReviews $ur)
{
    $tuserReview=<<< CONTENT
        <h1>Hello</h1>
CONTENT;
    return $tuserReview;
}

// ----------CONSOLE RENDERING--------------------------------------------

function renderConsoleSummary(array $pflist)
{
    $tconsolehtml = "";
    foreach($pflist as $pf)
    {
    $tconsole = <<<HTML
    <div class="row details">
     	<section class="panel panel-primary">
			<div class="panel-body">
				<h1>Playstation 5 &trade;</h1>
				<a class="btn btn-info" style="width: 125px; background-color: #a055ec; border-width: 2px;
                border-color: #FFF" href="https://direct.playstation.com/en-gb/buy-consoles/playstation5-console">
                Buy Now<br>£449.99</a>
				<a class="btn btn-primary" style="width: 125px; float: bottom" href="ps5regular.php?fixid=1">More Details...</a>
			</div>
			<img src=img/consoles/ps5.png width="200px">
		</section>
		<section class="panel panel-primary">
			<div class="panel-body">
				<h1>Playstation 5 Digital &trade;</h1>
				<a class="btn btn-info" style="width: 125px; background-color: #a055ec; border-width: 2px;
                border-color: #FFF" href="https://direct.playstation.com/en-gb/buy-consoles/playstation5-digital-edition-console">
                Buy Now<br>£359.99</a>
				<a class="btn btn-primary" style="width: 125px" href="ps5digital.php?fixid=2">More Details...</a>
			</div>
			<img src=img/consoles/ps5Digital.png width="200px">
		</section>
	</div>
HTML;
	$tconsolehtml=$tconsole;
    }
    return $tconsolehtml;
}


function renderConsoleDetails(BLLConsole $pf, $ptitle, $pid = "club-results")
{
    $treport = !empty($pf->report) ? $pf->report : "Games Console report to follow";

    $tconsole = <<<HTML
        <section>
				{$treport}
        </section>
        </div>
		</section>
HTML;
    return $tconsole;
}

// ----------PERIPHERAL RENDERING------------------------------------------------

function renderPeripheralSummary(array $pflist)
{
    $tperipheralhtml = "";
    foreach($pflist as $pf)
    {
        $tperipheral = <<<HTML
    <div class="row details">
     	<section class="panel panel-primary">
			<div class="panel-body">
				<h1>DualSense&trade; Controller</h1>
				<img src=img/peripherals/dualsense.png width="200px">
				<a class="btn btn-primary" href="https://direct.playstation.com/en-gb/buy-accessories/dualsense
				-wireless-controller?smcid=pdc:gb-en:web-pdc-accessories-dualsense-wireless-controller:subnav-
				Buy%20now:null:">£59.99<br>BUY NOW</a>
			</div>
		</section>
		<section class="panel panel-primary">
			<div class="panel-body">
				<h1>PULSE 3D&trade;<br>Wireless Headset</h1>
				<img src=img/peripherals/pulse3d.png width="200px">
				<a class="btn btn-primary" href="https://direct.playstation.com/en-gb/buy-accessories/pulse-
				3d-wireless-headset-ps5-ps4">£89.99<br>BUY NOW</a>
			</div>
		</section>
		<section class="panel panel-primary">
			<div class="panel-body">
				<h1>Media Remote<br>for PS5&trade;</h1>
				<img src=img/peripherals/mediaRemote.png width="200px">
				<a class="btn btn-primary" href="https://direct.playstation.com/en-gb/buy-accessories/media-remote?
				smcid=pdc:gb-en:web-pdc-accessories-media-remote:subnav-Buy%20now:null:">£24.99<br>BUY NOW</a>
			</div>
		</section>
		<section class="panel panel-primary">
			<div class="panel-body">
				<h1>HD Camera<br>for PS5&trade;</h1>
				<img src=img/peripherals/hdCamera.png width="200px">
				<a class="btn btn-primary" href="https://direct.playstation.com/en-gb/buy-accessories/hd-camera-
				for-ps5-consoles?smcid=pdc:gb-en:web-pdc-accessories-hd-camera:subnav-Buy%20now:null:"
				>£49.99<br>BUY NOW</a>
			</div>
		</section>
	</div>
HTML;
        $tperipheralhtml=$tperipheral;
    }
    return $tperipheralhtml;
}


// ----------KIT RENDERING------------------------------------------------
function renderKitTable(array $pkitlist)
{
    $trowdata = "";
    foreach ($pkitlist as $tk)
    {
        $tlink = "<a class=\"btn btn-info\" href=\"kit.php?kitid={$tk->id}\">More...</a>";
        $trowdata .= "<tr>
                          <td>{$tk->kittype}</td>
                          <td>{$tk->kityear}</td>
                          <td>{$tk->manufacturer}</td>
                          <td>{$tlink}</td>
                      </tr>";
    }
    $ttable = <<<TABLE
<table class="table table-striped table-hover">
	<thead>
		<tr>
	       	<th>Kit Desc</th>
			<th>Kit Year</th>
			<th>Kit Manufacturer</th>
			<th> </th>
		</tr>
	</thead>
	<tbody>
	   {$trowdata}
	</tbody>
</table>
TABLE;
    return $ttable;
}

function renderKitOverview(BLLKit $pkit)
{
    $tkithtml = <<<OV
    <h2>Kit Details</h2>
    <img src="img/kits/{$pkit->kitimage_href}" width="512"/>
    <h1>{$pkit->kittype} {$pkit->kityear}</h1>
    <h3>Sponsor: <strong>{$pkit->sponsor}</strong></h3>
    <h3>Manufacturer: <strong>{$pkit->manufacturer}</strong>
    <div class="col">
        <ul>
        <li>Shirt: <strong>{$pkit->shirtdesc}</strong></li>
        <li>Shorts:<strong>{$pkit->shortsdesc}</strong> </li>
        <li>Socks: <strong>{$pkit->socksdesc}</strong></li>
        </ul>
    </div>
OV;
    return $tkithtml;
}

// ----------STADIUM RENDERING--------------------------------------------
function renderStadiumSummary(BLLStadium $ps)
{
   $tshtml = <<<OVERVIEW
    <div class="well">
            <ul class="list-group">
                <li class="list-group-item">
                    Stadium Name: <strong>{$ps->name}</strong>
                </li>
                <li class="list-group-item">
                    Capacity: <strong>{$ps->capacity}</strong>
                </li>
                <li class="list-group-item">
                    Location: <strong>{$ps->addr}</strong>
                </li>
            </ul>
            <a class="btn btn-info" href="stadium.php?id={$ps->id}">Find out more...</a>
    </div>
OVERVIEW;
   return $tshtml;
}


//=============RENDER PRESENTATION LOGIC OBJECTS==================================================================
function renderUICarousel(array $pimgs, $pimgdir,$pid = "mycarousel")
{
    $tci = "";
    $count = 0;

    // -------Build the Images---------------------------------------------------------
    foreach ($pimgs as $titem) {
        $tactive = $count === 0 ? " active" : "";
        $thtml = <<<ITEM
        <div class="item{$tactive}">
            <img class="img-responsive" src="{$pimgdir}/{$titem->img_href}">
            <div class="container">
                <div class="carousel-caption">
                    <h1>{$titem->title}</h1>
                    <p class="lead">{$titem->lead}</p>
		        </div>
			</div>
	    </div>
ITEM;
        $tci .= $thtml;
        $count ++;
    }

    // --Build Navigation-------------------------
    $tdot = "";
    $tdotset = "";
    $tarrows = "";

    if ($count > 1) {
        for ($i = 0; $i < count($pimgs); $i ++) {
            if ($i === 0)
                $tdot .= "<li data-target=\"#{$pid}\" data-slide-to=\"$i\" class=\"active\"></li>";
            else
                $tdot .= "<li data-target=\"#{$pid}\" data-slide-to=\"$i\"></li>";
        }
        $tdotset = <<<INDICATOR
        <ol class="carousel-indicators">
        {$tdot}
        </ol>
INDICATOR;
    }
    if ($count > 1) {
        $tarrows = <<<ARROWS
		<a class="left carousel-control" href="#{$pid}" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#{$pid}" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
ARROWS;
    }

    $tcarousel = <<<CAROUSEL
    <div class="carousel slide" id="{$pid}">
            {$tdotset}
			<div class="carousel-inner">
				{$tci}
			</div>
		    {$tarrows}
    </div>
CAROUSEL;
    return $tcarousel;
}



function renderUIHomeArticle(PLHomeArticle $phome, $pwidth = 6)
{
    $thome = <<<HOME
    <article class="col-lg-{$pwidth}">
		<h2>{$phome->heading}</h2>
		<h4>
			<span class="label label-success">{$phome->tagline}</span>
		</h4>
		<div class="home-thumb">
			<img src="img/{$phome->storyimg_href}" />
		</div>
		<div>
		  <strong>
			{$phome->summary}
		  </strong>
		</div>
        <div>
		    {$phome->content}
        </div>
        <div class="options details">
			<a class="btn btn-info" href="{$phome->link}">{$phome->linktitle}</a>
        </div>
	</article>
HOME;
    return $thome;
}



function renderPagination($ppage,$pno,$pcurr)
{
    if($pno <= 1)
        return "";

        $titems = "";
        $tld= $pcurr == 1 ? " class=\"disabled\"" : "";
        $trd = $pcurr == $pno ? " class=\"disabled\"" : "";

        $tprev = $pcurr - 1;
        $tnext = $pcurr + 1;

        $titems .= "<li$tld><a href=\"{$ppage}?page={$tprev}\">&laquo;</a></li>";
        for($i = 1; $i <=$pno; $i++)
        {
            $ta = $pcurr == $i? " class=\"active\"" : "";
            $titems .= "<li$ta><a href=\"{$ppage}?page={$i}\">{$i}</a></li>";
        }
        $titems .= "<li$trd><a href=\"${ppage}?page={$tnext}\">&raquo;</a></li>";

        $tmarkup = <<<NAV
    <ul class="pagination pagination-sm">
        {$titems}
    </ul>
NAV;
        return $tmarkup;
}


?>