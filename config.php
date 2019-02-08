<?php
ob_start();
try{

   $con = new PDO("mysql:dbname = kovuyov1;host=localhost","root","");
   $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);


}
catch(PDOExeption $e){
     echo "Connection failed: ". $e->getMassage();
}
?>
