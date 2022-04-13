<?php
//// ----INCLUDE APIS------------------------------------
//include ("api/api.inc.php");
//
//// ----PAGE GENERATION LOGIC---------------------------
//function createFormPage()
//{
//    $tcontent = <<<PAGE
//    <form class="form-horizontal">
//	<fieldset>
//		<!-- Form Name -->
//		<legend>Enter new Game</legend>
//
//		<!-- Text input-->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="rankingNo">Squad Number</label>
//			<div class="col-md-4">
//				<input id="rankingNo" name="rankingNo" type="text" placeholder=""
//					class="form-register input-md" required=""> <span class="help-block">Enter
//					the Squad Number</span>
//			</div>
//		</div>
//
//		<!-- Text input-->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="fname">First Name</label>
//			<div class="col-md-4">
//				<input id="fname" name="fname" type="text" placeholder=""
//					class="form-register input-md" required=""> <span class="help-block">Enter
//					the Games First Name</span>
//			</div>
//		</div>
//
//		<!-- Text input-->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="lname">Last Name</label>
//			<div class="col-md-4">
//				<input id="lname" name="lname" type="text" placeholder=""
//					class="form-register input-md" required=""> <span class="help-block">Enter
//					the Game's Last Name</span>
//			</div>
//		</div>
//
//        <!-- Text input-->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="role">Role</label>
//			<div class="col-md-4">
//				<input id="role" name="role" type="text" placeholder=""
//					class="form-register input-md" >
//                <span class="help-block">Enter the Game's Role</span>
//			</div>
//		</div>
//
//		<!-- Select Basic -->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="pos">genre</label>
//			<div class="col-md-4">
//				<select id="pos" name="pos" class="form-register">
//					<option value="GK">GoalKeeper</option>
//					<option value="DF">Defender</option>
//					<option value="MF">Midfielder</option>
//					<option value="FW">Forward</option>
//					<option value="ST">Striker</option>
//				</select>
//                <span class="help-block">Select the Game's Position</span>
//			</div>
//		</div>
//
//		<!-- Select Basic -->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="nat">ageRating</label>
//			<div class="col-md-4">
//				<select id="nat" name="nat" class="form-register">
//					<option value="English">English</option>
//					<option value="Spanish">Spanish</option>
//					<option value="German">German</option>
//					<option value="Dutch">Dutch</option>
//					<option value="French">French</option>
//					<option value="Italian">Italian</option>
//					<option value="Brazilian">Brazilian</option>
//                    <option value="Argentinean">Argentinean</option>
//				</select>
//                <span class="help-block">Select the Game's ageRating</span>
//			</div>
//		</div>
//
//		<!-- Textarea -->
//		<div class="form-group">
//			<label class="col-md-4 control-label" for="bio">Game Biography</label>
//			<div class="col-md-4">
//				<textarea class="form-register" id="bio" name="bio"></textarea>
//                <span class="help-block">Enter a biography for the game</span>
//			</div>
//		</div>
//    </fieldset>
//    </form>
//PAGE;
//    return $tcontent;
//}
//
//// ----BUSINESS LOGIC---------------------------------
//
//session_start();
//$tpagecontent = "";
//
//if(appFormMethodIsPost())
//{
//    //Capture the Bio Data
//    $tbio = appFormProcessData($_REQUEST["bio"]  ?? "");
//    //Map the Form Data
//
//    $tvalid = true;
//    //TODO:  PUT SERVER-SIDE VALIDATION HERE
//
//    if($tvalid)
//    {
//
//    }
//    else
//    {
//        $tdest = appFormActionSelf();
//        $tpagecontent = <<<ERROR
//                         <div class="well">
//                            <h1>Form was Invalid</h1>
//                            <a class="btn btn-warning" href="{$tdest}">Try Again</a>
//                         </div>
//ERROR;
//    }
//}
//else
//{
//    //This page will be created by default.
//    $tpagecontent = createFormPage();
//}
//$tpagetitle = "Game Entry Page";
//$tpagelead = "";
//$tpagefooter = "";
//
//// ----BUILD OUR HTML PAGE----------------------------
//// Create an instance of our Page class
//$tpage = new MasterPage($tpagetitle);
//// Set the Three Dynamic Areas (1 and 3 have defaults)
//if (! empty($tpagelead))
//    $tpage->setDynamic1($tpagelead);
//$tpage->setDynamic2($tpagecontent);
//if (! empty($tpagefooter))
//    $tpage->setDynamic3($tpagefooter);
//    // Return the Dynamic Page to the user.
//$tpage->renderPage();
//
//?>