<?php

class PLHomeArticle extends SimpleXMLElement
{
    //-------CLASS FIELDS------------------
    public $heading;
    public $tagline;   
    public $content;
    public $summary;
    public $storyimg_href;
    public $link;
    public $linktitle;
}

class PLCarouselImage extends SimpleXMLElement
{
    //-------CLASS FIELDS------------------
    public $img_href;
    public $title;
    public $lead;

    //-------CONSTRUCTOR--------------------
}

?>