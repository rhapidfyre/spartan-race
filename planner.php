<?php
  //SELECT s.* FROM events e LEFT JOIN spartan s ON s.id = e.spartan_id WHERE e.id = 16;
  require_once('scripts/database.php');
  
  function SQLDateToDateStamp($dateInfo) {
    $stt = strtotime($dateInfo);
    return ( date('l, F jS, Y', $stt) );
  }
  
  function EventMileage($rt) {
    $dist = 0; $obst = 0;
    
    if ($rt < 2) {$dist = 5; $obst = 20;}
    elseif ($rt == 2) {$obst = 25;}
    elseif ($rt == 4) {$obst = 30;}
    elseif ($rt == 8) {$obst = 60;}
    
    if ($rt == 2 || $rt == 16) {$dist = 10;}
    elseif ($rt == 4 || $rt == 32) {$dist = 21.0975;}
    elseif ($rt == 8 || $rt == 64) {$dist = 42.195;}
    return Array( 0 => round($dist, 0), 1 => round($dist * 0.621371, 1), 2 => $obst );
  }
  
  $user = 1; // DEBUG
  
  $spartan_query = "
    SELECT e.*,a.id AS a_id,a.race_type FROM attendance a
      LEFT JOIN events e ON e.id = a.event_id
      LEFT JOIN users u ON u.id = a.user_id
    WHERE a.user_id = :myself
  ";
  
  $srace = $db->prepare($spartan_query);
  $srace->bindParam(':myself', $user);
  $srace->execute();
  $results = $srace->fetchAll();
  
  ?>
  <h3>Races of the same type on the same day do not count towards Trifectas</h3>
  <table class="ctr">
    <thead>
      <tr>
        <td></td>
        <td>Date</td>
        <td>Event Title</td>
        <td>mi</td>
        <td>km</td>
        <td>Obstacles</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($results as $row) {
?>
  <tr>
    <td><button onclick="RemoveEvent(<?php echo $row['a_id']; ?>)">REMOVE</button></td>
    <td><?php echo SQLDateToDateStamp($row['event_date']);?></td>
    <td><?php echo $row['location'].": ".$row['title'];?></td>
    <?php
      $dist = EventMileage($row['race_type']);
      echo '<td>'.$dist[1].'</td><td>'.$dist[0].'</td>';
    ?>
    <td>
    <?php
      echo '<td>'.$dist[2].'</td>';
    ?>
    </td>
  </tr>
<?php
  }
  ?></tbody></table><?php
?>