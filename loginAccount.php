<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();
$tmyname = $_REQUEST["myname"] ?? "";
$tmypassword = $_REQUEST["mypassword"] ?? "";
$tlogintoken = $_SESSION["myuser"] ?? "";
$registeredProfiles = file_get_contents('data/json/profiles.json');
$json = json_decode($registeredProfiles);

    if(empty($tlogintoken) && !empty($tmyname))
    {
        foreach ($json as $profile)
        {
            if ($profile->email == $tmyname)
            {
                if ($profile->password == $tmypassword)
                {
                    $_SESSION["myuser"] = appFormProcessDataWithNulls($tmyname);
                    $_SESSION["entered"] = true;
                    header("Location: index.php");
                }
                else
                {
                    $terror = "app_error.php";
                    header("Location: {$terror}");
                }
            }
            else
            {
                $terror = "app_error.php";
                header("Location: {$terror}");
            }
        }

    }
    else
    {
        $terror = "app_error.php";
        header("Location: {$terror}");

}




?>