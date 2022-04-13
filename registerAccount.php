<?php
// ----INCLUDE APIS------------------------------------
// Include our Website API
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pmethod, $paction, array $pform)
{
    $pform["inputEmail"] = null;
    $pform["inputPassword"] = null;
    $pform["confirmPassword"] = null;
    $pform["inputEmail"] = null;
    $pform["err-password"] = null;
//    nullAsEmpty($pform, "inputEmail");
//    nullAsEmpty($pform, "inputPassword");
//    nullAsEmpty($pform, "confirmPassword");
//    nullAsEmpty($pform, "firstName");
//    nullAsEmpty($pform, "lastName");
//    nullAsEmpty($pform, "err-firstName");
//    nullAsEmpty($pform, "err-password");
    $tcontent = <<<PAGE
<form class="form-horizontal" method="{$pmethod}" action="{$paction}">
		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">Email</label>
		        <div class="col-xs-9">
		            <input type="email" class="form-control" id="inputEmail" name="inputEmail" 
                      placeholder="Email" value="{$pform["inputEmail"]}">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword" class="control-label col-xs-3">Password</label>
		        <div class="col-xs-9">
		            <input type="password" class="form-control" id="inputPassword" 
                     name="inputPassword" placeholder="Password" value="{$pform["inputPassword"]}">
		        </div>
		    </div>
            <div class="form-group">
		        <label class="control-label col-xs-3" for="confirmPassword">Confirm Password:</label>
		        <div class="col-xs-9">
		            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" 
                       placeholder="Confirm Password" value="{$pform["confirmPassword"]}">
                       {$pform["err-password"]}
		        </div>
		    </div>
		    <div class="form-group">
		        <div class="col-xs-offset-3 col-xs-9">
		            <label class="checkbox-inline">
		                <input type="checkbox" value="agree" checked>  I agree to the <a href="#">Terms and Conditions</a>.
		            </label>
		        </div>
		    </div>
            <div class="form-group">
		        <div class="col-xs-offset-3 col-xs-9">
		            <input type="submit" class="btn btn-primary" value="Submit">
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
    $registeredProfiles = file_get_contents('data/json/profiles.json');
    $json = json_decode($registeredProfiles);
    foreach ($json as $profile)
    {
        if ($profile->email != $pformdata["inputEmail"])
        {
            $addProfile = array('email'=>$pformdata["inputEmail"],'password'=>$pformdata["confirmPassword"]);
            $jsonFile = file_get_contents('data/json/profiles.json');
            $tempArray = json_decode($jsonFile);
            $tempArray[] = $addProfile;
            $jsonFile = json_encode($tempArray);
            file_put_contents('data/json/profiles.json',$jsonFile);

            $tresponse = <<<RESPONSE
		<section class="panel panel-primary" id="Form Response">
				<div class="jumbotron">
					<h1>Thank You {$pformdata["inputEmail"]}</h1>
					<p class="lead">Your account has been created. 
                    Welcome to the GameStation Community!</p>
                    <li><a class="btn btn-info" href="index.php">Return Home & Login</a></li>
				</div>
		</section>
RESPONSE;
            return $tresponse;
        }
        else
        {
            $tresponse = <<<RESPONSE
		<section class="panel panel-primary" id="Form Response">
				<div class="jumbotron">
					<h1>Unfortunately, that email is already associated with another account</h1>
					<p class="lead">Please try a different email</p>
					<li><a class="btn btn-info" href="registerAccount.php">Register</a></li>
				</div>
		</section>
RESPONSE;
            return $tresponse;
        }
    }
}


function processForm(array $pformdata): array
{
    foreach ($pformdata as $tfield => $tvalue)
    {
        $pformdata[$tfield] = appFormProcessDataWithNulls($tvalue);
    }
    $tvalid = true;
    if ($tvalid && empty($pformdata["inputPassword"]))
    {
        $tvalid = false;
    }

    if ($tvalid && ($pformdata["inputPassword"]!=$pformdata["confirmPassword"]))
    {
        $tvalid = false;
        $pformdata["err-password"] = "<p id=\"help-password\" class=\"help-block\">Ensure the passwords are the same</p>";
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
$tmethod = "GET"; appFormMethod();
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