<?php
require_once("PHP/TemplateProvider.php");
require_once("PHP/DAL.php");

class SliderItem
{
    public $id;
    public $title;
    public $imageUrl;
    public $description;
    public $grade;
    

    public function __construct($id, $title, $imageUrl,$description,$grade)
    {
        $this->id = $id;
        $this->title = $title;
        $this->imageUrl = $imageUrl;
	    $this->description = $description;
        $this->grade = $grade;

    }

    public function generateHTML()
    {
        $html = TemplateProvider::getSliderTemplate();

        $html = str_replace("{{img}}", $this->imageUrl, $html);
        $html = str_replace("{{title}}", $this->title, $html);
        $html = str_replace("{{database_id}}", $this->id, $html);
		$html = str_replace("{{opis}}", $this->description, $html);
		$html = preg_replace('/rating-star selectedStar/','star', $html);
		$html = preg_replace('/rating-star/', 'rating-star selectedStar', $html,$this->grade);
		
        
        return $html;
    }


    public static function generateSliderItemHTML()
    {
        $html = "";

        $sliders = DAL::getSliderItems();

        /*foreach($sliders as $slider)
        {
            $html .= $slider->generateHTML();
        }*/
		
        $html .= $sliders[0]->generateHTML();
        return $html;
    }
	 
    public static function generateAllSliderItemsJSON()
	{
		$sliders = DAL::getSliderItems();		
        $jsonArray = array();
		
		foreach($sliders as $slider)
		{
			$jsonArray[] = array
			(
				"Title" => $slider->title,
				"Image_url" => $slider->imageUrl,
				"Description" => $slider->description,
				"Grade" => $slider->grade

			);
		}
		
		return json_encode($jsonArray);


	
    }
	
}

