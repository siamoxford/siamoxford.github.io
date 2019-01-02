<div class="container px-2 py-4">

  <?php
  require 'ics-parser/class.iCalReader.php';

  $file = new ical('https://calendar.google.com/calendar/ical/oxfordsiamchapter%40gmail.com/public/basic.ics');
  $icsEvents = array();
  $icsEvents= $file->events();
  /* Here we are getting the timezone to get the event dates according to gio location */

  $dateNow = new DateTime("now");
  $html = '<div class="table-responsive"><table class="table" id="seminarcal"><tbody>';

  foreach( array_reverse($icsEvents) as $icsEvent){

          /* Getting start date and time */
          $start = $icsEvent ['DTSTART'];
          $startDt = new DateTime ( $start );

          if ($dateNow > $startDt){
            $startDate = $startDt->format ( 'D d/m/y' );
            $startTime = $startDt->format ( 'Hi' );
            /* Getting end time */
            $end = $icsEvent ['DTEND'];
            $endDt = new DateTime ( $end );
            $endTime = $endDt->format ( 'Hi' );
            /* Getting the name of event */
            $eventName = $icsEvent['SUMMARY'];
            /* Getting the description of event */
            $eventDesc = $icsEvent['DESCRIPTION'];
            $eventDesc = str_replace('\n', '', $eventDesc);
            $eventDesc = str_replace("\,", ',', $eventDesc);
            $eventDetl = explode ( "\;", $eventDesc, 3 );
            $eventSpkr = $eventDetl[0];
            $eventInst = $eventDetl[1];
            $eventAbstr = $eventDetl[2];
            /* Getting the location of event */
            $eventLoc = $icsEvent['LOCATION'];
            $html .= '<tr class="mt-3"><td style="width:10rem"><span class="oi oi-calendar"></span> &nbsp; '.$startDate.'<br><span class="oi oi-clock"></span> &nbsp; '.$startTime.'-'.$endTime.'<br><span class="oi oi-map-marker"></span> &nbsp; &nbsp;'.$eventLoc.'</td><td style="width:auto"><span class="text-primary font-weight-bold">'.$eventName.'</span><br><span class="text-success"><span class="oi oi-person"></span> &nbsp; '.$eventSpkr.'</span><br><span class="text-secondary"><span class="oi oi-briefcase"></span> &nbsp; '.$eventInst.'</span><br>'.$eventAbstr.'</td></tr>';
          }

  }
  echo $html.'</tbody></table></div>';

  ?>
  <script>
    $(document).ready(function() {
        $('#seminarcal').DataTable();
    } );
  </script>



</div>
