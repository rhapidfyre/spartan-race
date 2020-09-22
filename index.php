<html>
<head>
  <title>OCR Race Planner</title>
  <link rel="stylesheet" type="text/css" href="inc/index.css">
  <link rel="stylesheet" type="text/css" href="inc/account.css">
  <link rel="stylesheet" type="text/css" href="inc/events.css">
  <link rel="stylesheet" type="text/css" href="inc/planner.css">

  <style>
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  
  /*
    Uses the e_id and raceEvent to determine what event the user
    is trying to add, and then adds it to their planner if they aren't
    already registered for that type of race at that event.

    Will allow people to add the same event multiple times.
    The trifecta calculator will take that into effect.
  */
  
  function AddEvent(e_id, raceEvent) {
    $.ajax({
      url: 'scripts/event_info.php', type: "POST",
      dataType: "json",
      data: {idEvent: e_id, evType: raceEvent},
      success: function(retData) {
        let temp = (parseInt(retData, 10) || 0);
        if(temp < 1)
          alert("Event Not Found.");
        else
          $('#events-chosen').load('planner.php');
      }
    });
  }
  
  function RemoveEvent(a_id) {
    $.ajax({
      url: "scripts/event_remove.php", type: "POST",
      dataType: 'json',
      data: {idEvent: a_id},
      cache: false
    }).done(function(data) {
      alert('done');
      $('#events-chosen').load('planner.php');
    });
  }
  
  </script>
</head>

<body>

  <div id="main-body">

    <div id="main-top">
    
      <!-- User Account, or if not logged in, generic details -->
      <div id="account-info">
        <?php include ('account.php'); ?>
      </div>
  
      <!-- All events, combined by event sub-id -->
      <div id="events-listing">
        <?php include ('events.php'); ?>
      </div>
      
    </div>
    
    <div id="main-bottom">
    
      <!-- Events that the user has added to their scheduler -->
      <div id="events-chosen">
        <?php include ('planner.php'); ?>
      </div>
      
    </div>
    
  </div>

  <!-- Website Information -->
  <div id="footer">
    <?php include ('footer.php'); ?>
  </div>

</body>

</html>