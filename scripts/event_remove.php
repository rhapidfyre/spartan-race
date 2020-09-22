<?php
  require_once('database.php');
  $iQuery = "DELETE FROM attendance WHERE user_id = :usr AND id = :a";
  $iRace = $db->prepare($iQuery);
  $iRace->bindParam(':usr', 1);
  $iRace->bindParam(':a', $_POST['idEvent']);
  $iRace->execute();
  echo json_encode("Success");
  exit();
?>