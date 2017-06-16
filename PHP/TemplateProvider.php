<?php 
class TemplateProvider
{
	public static function getSliderTemplate()
	{
		return self::_getFileContent("templates/slider.html");
	}
	
	
	public static function getCardTemplate()
	{
		return self::_getFileContent("templates/card.html");
	}
	
	

	private static function _getFileContent($filePath)
	{
		$file = fopen($filePath, "r") or die("Unable to open file!");
		$fileContent = fread($file, filesize($filePath));
		fclose($file);
		
		return $fileContent;
	}
}