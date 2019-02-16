
<?php
class ImageResultProvider {

	private $con;

	public function __construct($con) {
		$this->con = $con;
	}

	public function getNumResults($term) {

		$query = $this->con->prepare("SELECT COUNT(*) as total 
										 FROM images 
										 WHERE (title LIKE :term 
										 OR alt LIKE :term)
										 AND broken=0");

		$searchTerm = "%". $term . "%";
		$query->bindParam(":term", $searchTerm);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row["total"];

	}
public function getResultsHtml($page, $pageSize, $term) {

        $fromLimit = ($page-1)*$pageSize;

	 	$query = $this->con->prepare("SELECT *  
										 FROM images 
										 WHERE (title LIKE :term 
										 OR alt LIKE :term)
										 AND broken=0
										 ORDER BY clicks DESC
										 LIMIT :fromLimit,:pageSize");

		$searchTerm = "%". $term . "%";
		$query->bindParam(":term", $searchTerm);
		$query->bindParam(":fromLimit", $fromLimit, PDO::PARAM_INT);
		$query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
		$query->execute();

        $resultsHtml = "<div class = 'imageResults'>";
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
          
          $id = $row["id"];
          $imageUrl = $row["imageURL"];
          $title = $row["title"];
          $alt = $row["alt"];
          $siteURL = $row["siteURL"];


          if($title){
             $displayText  = $title;
          }elseif ($alt) {
          	 $displayText = $alt;
          }else{
          	$displayText = $imageUrl;
          }

          //$title = $this->trimField($title,55);
          //$description = $this->trimField($description,230);

          $resultsHtml .="<div class='gridItem'>
                            
                            <a href='$imageUrl'>
                              <img src='$imageUrl'>
                              <span class='details'>$displayText</span>     
                            </a>
                           
                                                     
                          </div>";
        }
		
		$resultsHtml .= "</div>";

		return $resultsHtml;

	}

  
  
}
?>