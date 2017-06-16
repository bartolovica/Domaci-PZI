<?

require_once("PHP/model/Slider.php");
require_once("PHP/model/Cards.php");
require_once("PHP/DAL.php");

class API
{
	public static function processRequest()
	{
		$action = self::_getParameterValue("action");
		
		switch($action)
		{
			case "getSliderItems": return SliderItem::generateAllSliderItemsJSON();
			case "addImage": return self::_processAddImage();
			case "removeImage": return self::_processRemoveImage();
			//case "getSliderItemById": return self::_processGetSliderItemById();
			case "editSliderItem": return self::_processEditSliderItem();
			case "starsSet": return self::_procesStarsSet();
			case "addLinks":return self::_processAddLinks();
			default: return self::_sendErrorAndDie("Unknown request");
		}
	}

	private static function _processAddImage() 
	{
		$imageUrl = self::_getParameterValue("imageUrl");	
		$title = self::_getParameterValue("title");
		
		if($imageUrl == "" || $title == "")
		{
			self::_sendErrorAndDie("Niste upisali parametre!");
			return;
		}
		//We need the ID on the client side
		$id = DAL::addImage($title, $imageUrl);
		
		return json_encode(array
		(
			"success" => true,
			"data.id" => $id
		));
	}

	private static function _processRemoveImage()
	{
		$id = self::_getParameterValue("id");
		
		if($id == "")
		{
			self::_sendErrorAndDie("Nema id-a");
			return;
		}
		
		DAL::removeImage($id);
		
		return json_encode(array
		(
			"success" => true
		));
	}

	private static function _processGetSliderItemById()

	{
		$id = self::_getParameterValue("ID");
		
		if($id == "")
		{
			self::_sendErrorAndDie("Invalid add new gallery item parameters!");
			return;			
		}
		
		$row = DAL::getSliderItemById($id);
		echo json_encode($row[0]);		
	}

	private static function _processEditSliderItem()	{
		$id = self::_getParameterValue("id");
		$opis = self::_getParameterValue("opis");
		
		if($id == "" || !is_numeric($id) || $opis == "")
		{
			self::_sendErrorAndDie("editani parametri fale!");
			return;
		}
		
		DAL::editSliderItem($id, $opis);
		return json_encode(array
		(
			"success" => true
		));
	}

	private static function _procesStarsSet()	
{
		$title = self::_getParameterValue("title");
		$grade = self::_getParameterValue("grade");
		if($title == "" || $grade == "" )
		{
			self::_sendErrorAndDie("Fale parametri!");
			return;
		}
		
		DAL::starsSet($title, $grade);
		return json_encode(array
		(
			"success" => true
		));	
	}


	private static function _sendErrorAndDie($message)
	{
		header("HTTP/1.1 400 Invalid Request");
		die(json_encode(array
		(
			"success" => false,
			"message" => $message
		)));
	}
	
	private static function _getParameterValue($key)
	{
		return isset($_REQUEST[$key]) ? $_REQUEST[$key]
									  : "";
	}
}

echo(API::processRequest());