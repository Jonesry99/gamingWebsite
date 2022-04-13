<?php
// ----INCLUDE APIS------------------------------------
// Include our Website API
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pmethod, $paction, array $pform): string
{
    nullAsEmpty($pform, "gameName");
    nullAsEmpty($pform, "gameScore");
    nullAsEmpty($pform, "gameReview");
    $tcontent = <<<PAGE
<form class="form-horizontal" method="{$pmethod}" action="{$paction}">

            <div class="form-group">
                <label class="control-label col-xs-3" for="gameName">Name of Game:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" id="gameName" 
                    name="gameName" placeholder="Game Name" value="{$pform["gameName"]}">
                </div>
            </div>
            <div class="form-group">
	           <label class="control-label col-xs-3">Game Score (out of 5):</label>
	           <div class="col-xs-3">
		            <select class="form-control">
		                <option selected disabled>Score</option>
		                <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		                <option>5</option>
		            </select>
		       </div>
            </div>
            <div class="form-group">
		        <label class="control-label col-xs-3" for="gameReview">Game Review</label>
		        <div class="col-xs-9">
		            <textarea rows="3" class="form-control" id="gameReview" placeholder="Review of Game"></textarea>
		        </div>
		    </div>
		    <div class="form-group">
		        <div class="col-xs-offset-3 col-xs-9">
		            <label class="checkbox-inline">
		                <input type="checkbox" value="agree" checked>  I agree to post this review publicly</a>.
		            </label>
		        </div>
		    </div>
            <div class="form-group">
		        <div class="col-xs-offset-3 col-xs-9">
		            <input type="submit" class="btn btn-primary" value="Post Review">
		            <input type="reset" class="btn btn-default" value="Reset">
		        </div>
		    </div>
		</form>
PAGE;
    return $tcontent;
}

function nullAsEmpty(array $pform, string $string)
{

}

function createResponse(array $pformdata)
{
    $tlogintoken = $_SESSION["myuser"] ?? "";
    loginUser($pformdata["firstName"] + $pformdata["lastName"],$tlogintoken);
    $tresponse = <<<RESPONSE
		<section class="panel panel-primary" id="Form Response">
				<div class="jumbotron">
					<h1>Thank You {$pformdata["firstName"]} {$pformdata["lastName"]}</h1>
					<p class="lead">Your account has been created. 
                    Thank you for keeping up to date with everything Gaming!</p>
					<p class="lead">You will receive weekly updates to {$pformdata["inputEmail"]} </p>
				</div>
		</section>
RESPONSE;
    return $tresponse;
}

function processForm(array $pformdata): array
{
    foreach ($pformdata as $tfield => $tvalue)
    {
        $pformdata[$tfield] = appFormProcessDataWithNulls($tvalue);
    }
    $tvalid = true;
    if ($tvalid && empty($pformdata["firstName"]))
    {
        $tvalid = false;
        $pformdata["err-firstName"] = "<p id=\"help-firstName\" class=\"help-block\">First Name Required</p>";
    }
    if ($tvalid && empty($pformdata["inputPassword"]))
    {
        $tvalid = false;
    }

    if ($tvalid && ($pformdata["inputPassword"]!=$pformdata["confirmPassword"]))
    {
        $tvalid = false;
        $pformdata["err-password"] = "<p id=\"help-password\" class=\"help-block\">Make sure passwords are the same</p>";
    }

    if ($tvalid && empty($pformdata["confirmPassword"]))
    {
        $tvalid = false;
    }
    if ($tvalid && $pformdata["confirmPassword"] != $pformdata["inputPassword"])
    {
        $tvalid = false;
    }
    if ($tvalid)
    {
        $pformdata["valid"] = true;
    }
    return $pformdata;
}

// ----BUSINESS LOGIC---------------------------------
$taction = htmlspecialchars($_SERVER['PHP_SELF']);
$tmethod = "GET";
$tformdata = processForm($_REQUEST) ?? array();

if (isset($tformdata["valid"]))
{
    $tpagecontent = createResponse($tformdata);
}
else
{
    $tpagecontent = createPage($tmethod, $taction, $tformdata);
}

// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tindexpage = new MasterPage("Data Entry");
$tindexpage->setDynamic2($tpagecontent);
$tindexpage->renderPage();

?>