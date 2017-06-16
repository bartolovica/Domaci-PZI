<?php
require_once("PHP/TemplateProvider.php");
require_once("PHP/DAL.php");

class Card
{
    public $id;
    public $title;
    public $imageUrl;
    

    public function __construct($id, $title, $imageUrl)
    {
        $this->id = $id;
        $this->title = $title;
        $this->imageUrl = $imageUrl;
    }

    public function generateHTML()
    {
        $html = TemplateProvider::getCardTemplate();

        $html = str_replace("{{img}}", $this->imageUrl, $html);
        $html = str_replace("{{title}}", $this->title, $html);
        $html = str_replace("{{data.id}}", $this->id, $html);

        return $html;
    }


    public static function generateAllCardsHTML()
    {
        $html = "";

        $cards = DAL::getCards();

        foreach($cards as $card)
        {
            $html .= $card->generateHTML();
        }

        return $html;
    }
	
	public static function generateAllCardsJSON()
	{
		$cards = DAL::getCards();
		$jsonArray = array();
		
		foreach($cards as $card)
		{
			$jsonArray[] = array
			(
				"title" => $card->title,
				"imageUrl" => $card->imageUrl
				
			);
		}
		
		return json_encode($jsonArray);
	}
	
	
	
}