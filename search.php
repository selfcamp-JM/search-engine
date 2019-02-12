
<?php 
 include("config.php");
 include("classes/SitesResultsProvider.php");

  if(isset($_GET["term"])){
    $term = $_GET["term"];
  }
  else{
    exit("You must enter search"); 
  }

  $type = isset($_GET["type"]) ? $_GET["type"] : "sites";
  
?>
<! DOCTYPE html>

<html>
  <head>
    <title>Kovuyov</title>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>
 <body>
 
 <div class="wrapper">
    <div class="header">
        <div class ="headerContent">
            <div class ="logoContainer">
                <a href="index.php"><img src="assets/image/festisite_google.png" /></a>
            </div>
            
            <div class="seachContainer">
                <form action="search.php" method = "GET">
                    <div class="searchBarContainer">
                        <input class="searchBox" type="text" name="term">
                        <button class="searchButton">
                            <img src="assets/image/icons/icons8-search-24.png"/>
                        </button>
                    </div>
                </form>
            </div>
 
        </div> 
        
        <div class="tabsContainer">
          <ul class="tabList">
              <li class="<?php echo $type =='sites' ? 'active' : '' ?>">
                <a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
                   Sites
                </a>
              </li>
              <li class="<?php echo $type =='images' ? 'active' : '' ?>">
                <a href='<?php echo "search.php?term=$term&type=images"; ?>'>
                   Images
                </a>
              </li>          
          </ul>    

        </div>

    </div>



    <div class="mainResultsSection">
      <?php 
        $resultsProvider = new SitesResultsProvider($con);
        $numResults =  $resultsProvider->getNumResults($term);
        echo "<p class = 'resultsCount'>$numResults results found</p>";

        echo $resultsProvider->getResultsHtml(1,20, $term);
      ?>
    </div>






 </div>

 </body>
</html>