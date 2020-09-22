<?php
  require_once('database.php');
  $iQuery = "SELECT IsRegistered(:evid, :rtype, 1)";
  $iRace = $db->prepare($iQuery);
  $iRace->bindParam(':evid', $_POST['idEvent']);
  $iRace->bindParam(':rtype', $_POST['evType']);
  $iRace->execute();
  $iInfo = $iRace->fetchColumn();
  echo json_encode($iInfo);
  exit();
?>