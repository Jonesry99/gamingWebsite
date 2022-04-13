<?php


class BLLUserReviews
{
    public $id = null;
    public $userEmail;
    public $userGame;
    public $userReview;
    public $userRating;
}

class BLLGame 
{
    //-------CLASS FIELDS------------------
    public $id = null;
    public $rankingNo;
    public $genre;
    public $gameName;
    public $ageRating;
    public $gameScore;
    public $gameStationReview;
    public $gameBuy1;
    public $gameBuy2;
    public $gameBuy3;
    public $gamePrice;
    public $gameSummary;
    public $gameVideo1;
    public $gameVideo2;
    public $gameVideo3;
    
    public function fromArray(stdClass $passoc)
    {
        foreach($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}


class BLLSquad
{
    //-------CLASS FIELDS------------------
    public $id = null;
    public $squadlist;
    public $squadname;
    public $captainindex;
    public $stargameindex;

    public function fromArray(stdClass $passoc)
    {
        foreach($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}




class BLLConsole
{
    //-------CLASS FIELDS------------------
    public $id = null;
    public $report;
    public $report_href;

    public function fromArray(stdClass $passoc)
    {
        foreach($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}


?>