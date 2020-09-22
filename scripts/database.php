<?php
  
  $user = 'mike';            //$user = 'rpuser';
  $pass = 'mah1384MAH!#*$'; //$pass = 'rplan1#8$';
  
  try {
      $db = new PDO('mysql:host=localhost;dbname=raceplan', $user, $pass);
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  
?>