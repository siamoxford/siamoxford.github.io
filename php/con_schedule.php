<div class="container px-0 py-4">

  <?php
  require 'ics-parser/class.iCalReader.php';

  $file = new ical('https://calendar.google.com/calendar/ical/nt43ft44euaphbrp3otpeas0js%40group.calendar.google.com/public/basic.ics');
  $icsEvents = array();
  $icsEvents= $file->eventsFromRange(false, false);
  /* Here we are getting the timezone to get the event dates according to gio location */

  $html = '<table class="table" ><tbody>';

  foreach( $icsEvents as $icsEvent){

          /* Getting start date and time */
          $start = $icsEvent ['DTSTART'];
          $startDt = new DateTime ( $start );
          $startDt->setTimeZone(new DateTimeZone('Europe/London'));
          $startTime = $startDt->format ( 'Hi' );
          /* Getting end time */
          $end = $icsEvent ['DTEND'];
          $endDt = new DateTime ( $end );
          $endDt->setTimeZone(new DateTimeZone('Europe/London'));
          $endTime = $endDt->format ( 'Hi' );
          /* Getting the name of event */
          $eventName = $icsEvent['SUMMARY'];
          /* Getting the description of event */
          $eventDesc = $icsEvent['DESCRIPTION'];
          $eventDesc = str_replace('\n', '', $eventDesc);
          $eventDesc = str_replace("\,", ',', $eventDesc);
          $eventDetl = explode ( "\;", $eventDesc, 3 );

          /* Getting the location of event */
          $eventLoc = $icsEvent['LOCATION'];
          $html .= '<tr class="my-2"><td style="width:12rem"><span class="oi oi-clock"></span> &nbsp; '.$startTime.'-'.$endTime.'<br><span class="oi oi-map-marker"></span> &nbsp; &nbsp;'.$eventLoc.'</td><td style="width:auto"><h6 class="text-primary font-weight-bold">'.$eventName.'</h6>' ;
          if((isset($eventDetl[0])) && !(empty($eventDetl[0]))) {
            $eventSpkr = $eventDetl[0];
            $html.= '<span class="text-success"><span class="oi oi-person"></span> &nbsp; '.$eventSpkr.'</span>' ;
          }
          if(isset($eventDetl[1])) {
            $eventInst = $eventDetl[1];
            $html.='<br><span class="text-secondary"><span class="oi oi-briefcase"></span> &nbsp; '.$eventInst.'</span> <br>';

          }
          if(isset($eventDetl[2])) {
            $eventAbstr = $eventDetl[2];
            $html.='<button class="btn btn-primary my-2" type="button" data-toggle="collapse" data-target="#a';
            $html.=$startTime.'" aria-expanded="false" aria-controls="collapseExample">Abstract</button>';
            $html.='<div class="collapse" id="a'.$startTime.'"><div class="card card-body">'.$eventAbstr.'</div></div>';

          }

          $html.='</td></tr>';


  }
  echo $html.'</tbody></table>';

  ?>


</div>
