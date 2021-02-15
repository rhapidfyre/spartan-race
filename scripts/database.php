<?php
  
  $user = 'raceplan';
  $pass = 'rplanner'; // insecure but fine for localhost only access during dev
  
  try {
      $db = new PDO('mysql:host=localhost;dbname=raceplan', $user, $pass);
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  
?>
