<?php
require_once("model/Cards.php");
require_once("model/Slider.php");
require_once("DatabaseAccess.php");

class DAL
{
    public static function getCards()
    {
        $dbAccess = self::_getDbAccess();
		$cards = array();
		
		$rows = $dbAccess->executeQuery("SELECT * FROM Images;");
		
		foreach($rows as $row)
		{
			
			$cards[] = new Card($row[0], $row[1], $row[2]);
		}
		
		return $cards;
    }
  
    public static function getSliderItems()
    {
        $dbAccess = self::_getDbAccess();
		$Items = array();
		
		$rows = $dbAccess->executeQuery("SELECT * FROM Items;");
		
		foreach($rows as $row)
		{
			$Items[] = new SliderItem($row[0], $row[1], $row[2],$row[3], $row[4]);
		}
		
		return $Items;
    }

    public static function addImage($title, $image_url)
    {
        $dbAccess = self::_getDbAccess();        
		
		$dbAccess->executeQuery("INSERT INTO Images (ime, url_slike) VALUES ( '$title', '$image_url');");
		
		//Select the last inserted ID
		$result = $dbAccess->executeQuery("SELECT id FROM Images ORDER BY id DESC LIMIT 1;");
		
		return $result[0][0];
    }


    public static function removeImage($id)
    {
		$dbAccess = self::_getDbAccess();
		
		$dbAccess->executeQuery("DELETE FROM Images WHERE id='$id';");
		
    }

     public static function getSliderItemById($id)
    {
		$dbAccess = self::_getDbAccess();
		
		$row=$dbAccess->executeQuery("SELECT * FROM Slider WHERE ID='$id';");
		return $row;
    }

     public static function editSliderItem($id, $description)
    {
		$dbAccess = self::_getDbAccess();
		
		$dbAccess->executeQuery("UPDATE Slider SET opis='$description' WHERE id='$id';");

		
    }

public static function starsSet($title, $grade)
	{
		$dbAccess = self::_getDbAccess();
		
		$dbAccess->executeQuery("UPDATE Slider SET ocjena='$grade' WHERE naslov='$title';");
		
			
	}

    private static function _getDbAccess()
    {
    	return new DatabaseAccess("bartolovica", "bartolovica", "bartolovica");
    }
}