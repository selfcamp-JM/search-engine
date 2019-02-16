
<?php 
 include("config.php");
 include("classes/SitesResultsProvider.php");
 include("classes/ImageResultProvider.php");

  if(isset($_GET["term"])){
    $term = $_GET["term"];
  }
  else{
    exit("You must enter search"); 
  }

  $type = isset($_GET["type"]) ? $_GET["type"] : "sites";
  $page = isset($_GET["page"]) ? $_GET["page"] : 1;

  
?>
<! DOCTYPE html>

<html>
  <head>
    <title>Kovuyov</title>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

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
                  <input type="hidden" name="type" value="<?php echo $type; ?>"> 
                    <div class="searchBarContainer">
                        <input class="searchBox" type="text" name="term" value="<?php echo $term; ?>">
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
        if($type == "sites"){
          $resultsProvider = new SitesResultsProvider($con);
          $pageSize = 20;
        }else{
          $resultsProvider = new ImageResultProvider($con);
          $pageSize = 40;
        }
        

        $numResults =  $resultsProvider->getNumResults($term);
        echo "<p class = 'resultsCount'>$numResults results found</p>";

        echo $resultsProvider->getResultsHtml($page,$pageSize, $term);
      ?>
    </div>


    <div class="paginationContainer"> 
      
      <div class="pageButtons">
        <div class="pageNumberConteiner"> 
           <img src ="assets/image/pagestart.png">
        </div>


        <?php

           $pageToShow = 10;
           $numPages = ceil($numResults / $pageSize);
           $pageLeft = min($pageToShow,$numPages);
           
           $currentPage = $page - floor($pageToShow /2);
           
           if($currentPage<1){
            $currentPage = 1; 
           }
           if($currentPage + $pageLeft > $numPages+1){
                 $currentPage = $numPages + 1 - $pageLeft;
           }

           while ($pageLeft!=0 && $currentPage<=$numPages) {
                
                if($currentPage == $page){
                  echo "<div class='pageNumberConteiner'>
                      <img src ='assets/image/pageselected.png'>
                      <span class='pageNumber'>$currentPage</span>
                 </div>";
               }else{
                echo "<div class='pageNumberConteiner'>
                     <a href='search.php?term=$term&type=$type&page=$currentPage'>
                       <img src ='assets/image/page.png'>
                       <span class='pageNumber'>$currentPage</span>
                     </a>
                 </div>";
               }
                
             $currentPage++;
             $pageLeft--;

           }
           
 
         ?>
       
       <div class="pageNumberConteiner"> 
           <img src ="assets/image/pageselected.png">
        </div>
       
        <div class="pageNumberConteiner"> 
           <img src ="assets/image/pageEnd.png">
        </div>
      </div>
    
    </div>






 </div>
 <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="assets/js/script.js"></script>
 </body>
</html>