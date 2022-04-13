<?php

//Include our HTML Page Class
require_once("htmlPageSys.php");

class MasterPage
{
    //-------FIELD MEMBERS----------------------------------------
    private $_htmlpage;     //Holds our Custom Instance of an HTML Page
    private $_dynamic_1;    //Field Representing our Dynamic Content #1
    private $_dynamic_2;    //Field Representing our Dynamic Content #2
    private $_dynamic_3;    //Field Representing our Dynamic Content #3
    private $_game_ids;
    
    //-------CONSTRUCTORS-----------------------------------------
    function __construct($ptitle)
    {
        $this->_htmlpage = new HTMLPage($ptitle);
        $this->setPageDefaults();
        $this->setDynamicDefaults(); 
        $this->_game_ids = [1,2,3,4,5,6,7,8,9,10];
    }
    
    //-------GETTER/SETTER FUNCTIONS------------------------------
//    public function getDynamic1() { return $this->_dynamic_1; }
//    public function getDynamic2() { return $this->_dynamic_2; }
//    public function getDynamic3() { return $this->_dynamic_3; }
    public function setDynamic1($phtml) { $this->_dynamic_1 = $phtml; }
    public function setDynamic2($phtml) { $this->_dynamic_2 = $phtml; } 
    public function setDynamic3($phtml) { $this->_dynamic_3 = $phtml; }
    public function getPage(): HTMLPage { return $this->_htmlpage; } 
    
    //-------PUBLIC FUNCTIONS-------------------------------------
                   
//    public function createPage()
//    {
//       //Create our Dynamic Injected Master Page
//       $this->setMasterContent();
//       //Return the HTML Page..
//       return $this->_htmlpage->createPage();
//    }
    
    public function renderPage()
    {
       //Create our Dynamic Injected Master Page
       $this->setMasterContent();
       //Echo the page immediately.
       $this->_htmlpage->renderPage();
    }
    
    public function addCSSFile($pcssfile)
    {
        $this->_htmlpage->addCSSFile($pcssfile);
    }
    
    public function addScriptFile($pjsfile)
    {
        $this->_htmlpage->addScriptFile($pjsfile);
    }
    
    //-------PRIVATE FUNCTIONS-----------------------------------    
    private function setPageDefaults()
    {
        $this->_htmlpage->setMediaDirectory("css","js","fonts","img","data");
        $this->addCSSFile("bootstrap.css");
        $this->addCSSFile("site.css");
        $this->addScriptFile("jquery-2.2.4.js");
        $this->addScriptFile("bootstrap.js");
        $this->addScriptFile("holder.js");        
    }
    
    private function setDynamicDefaults()
    {
        $tcurryear = date("Y");
        //Set the Three Dynamic Points to Empty By Default.
        $this->_dynamic_1 = <<<JUMBO
<h1 style="font-family: 'Agency FB'">GameStation</h1>
<p class="lead" style="font-family: 'Agency FB'">Finding The Perfect Games For You</p>
JUMBO;
        $this->_dynamic_2 = "";
        $this->_dynamic_3 = <<<FOOTER
<p>Ryan Jones &copy; {$tcurryear}</p>
FOOTER;
    }
    
    private function setMasterContent()
    {
        $tlogin = "loginAccount.php";
        $tlogout = "logoutAccount.php";

        $tregister = "registerAccount.php";

        $tentryhtml = <<<FORM
        <ul class="nav nav-pills pull-right">
        <li><a class="btn btn-info" href="{$tregister}">Register</a></li>
        <li><form id="signin" action="{$tlogin}" class="navbar-form" method="post" role="form">
        <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i>
        
        </span>
        <input id="email" type="email" class="form-control" name="myname" value="" placeholder="Enter Email Address" style="height: 20px"><br>
        <input id="password" type="password" class="form-control" name="mypassword" value="" placeholder="Enter Password" style="height: 20px">
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
        </form></li>
        </ul>
FORM;
        $tuser = $_SESSION["myuser"] ?? "";
        $texithtml = <<<EXIT
        <div class="navbar-right">
        <a class="btn btn-info"
            href="http://localhost/writeReview.php" style="background-color: #28b52d">Write a Review</a>
        <a class="btn btn-info"
            href="http://localhost/userProfile.php" style="background-color: #9f54eb">View Profile</a>
        <a class="btn btn-info"
            href="{$tlogout}?action=exit">Log Out | {$tuser}</a>
        </div>
EXIT;

        $tauth = isset($_SESSION["myuser"]) ? $texithtml : $tentryhtml;
        $tid = $this->_game_ids[array_rand($this->_game_ids,1)];
        $tmasterpage = <<<MASTER
<div class="container">
    <div class="jumbotron">
		{$this->_dynamic_1}
    </div>
    
	<div class="header clearfix">
		<nav>
		    {$tauth}
			<ul class="nav nav-pills pull-right">
				<li role="presentation"><a href="index.php">Home</a></li>
				<li role="presentation"><a href="gameLibrary.php">Games</a></li>
				<li role="presentation"><a href="gamesConsoles.php">Games Consoles</a></li>
                <li role="presentation"><a href="peripherals.php">Gaming Peripherals</a></li>
                <li role="presentation"><a href="game.php?id={$tid}">Random Game!</a></li>
			</ul>			

		</nav>
	</div>
	<div class="row details">
		{$this->_dynamic_2}
    </div>
    <footer class="footer">
		{$this->_dynamic_3}
	</footer>
</div>        
MASTER;
        $this->_htmlpage->setBodyContent($tmasterpage);
    }
}

?>