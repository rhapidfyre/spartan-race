<?php
  require_once('scripts/database.php');

  // Put all events from the events database into a variable
  $race = $db->query("SELECT * FROM events");

  $imgURL = 'img/icons/logo_';
  $races = Array(
    0    => "stadion",
    1    => "sprint",
    2    => "super",
    4    => "beast",
    8    => "ultra",
    16   => "trail_10",
    32   => "trail_half",
    64   => "trail_mara",
    128  => "hh",
    256  => "hh12",
    512  => "hh24",
    1024 => "death",
    2048 => "agoge"
  );
  
  function SQLDateToDay($dateInfo) {
    $stt = strtotime($dateInfo);
    return ( date('l', $stt) );
  }

  function SQLDateToDate($dateInfo) {
    $stt = strtotime($dateInfo);
    return ( date('M j Y', $stt) );
  }



?>
  <div id="events-table">
  <table>
<?php
  foreach($race->fetchAll(PDO::FETCH_ASSOC) as $row) {
?>
    <tr class="separator">
      <td class="title"><?php echo $row['location'];?></td>
      <td class="title"><?php echo SQLDateToDay($row['event_date']); ?></td>
      <?php
        foreach($races as $k => $v) {
          if ($k & $row['races']) {
            echo '<td class="img-24">';
            echo '<button onclick="AddEvent('.$row['id'].', \''.$k.'\')">';
            echo '<img src="'. $imgURL . $v . '.png">';
            echo '</button></td>';
          }
        }

      ?>
    </tr>


<?php
  }

?>
  </table>
  </div>