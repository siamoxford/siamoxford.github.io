<div class="container px-2 py-4">

  <?php
  require 'ics-parser/class.iCalReader.php';

  $file = new ical('https://calendar.google.com/calendar/ical/oxfordsiamchapter%40gmail.com/public/basic.ics');
  $icsEvents = array();
  $icsEvents= $file->eventsFromRange('now', '2100/01/01');
  /* Here we are getting the timezone to get the event dates according to gio location */

  $dateNow = new DateTime("now");
  $icsEvent = $icsEvents[0];

  /* Getting start date and time */
  $start = $icsEvent ['DTSTART'];
  $startDt = new DateTime ( $start );

  if ($dateNow <= $startDt){
    $startDate = $startDt->format ( 'D d/m' );
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
    $html = '<span class="text-primary font-weight-bold">'.$eventName.'</span><br><br><span class="oi oi-calendar"></span> &nbsp; '.$startDate.'&nbsp; &nbsp; <span class="oi oi-clock"></span> &nbsp; '.$startTime.'&nbsp; &nbsp;<span class="oi oi-map-marker"></span> &nbsp'.$eventLoc.'<br><span class="oi oi-person"></span> &nbsp; '.$eventSpkr.'<br><span class="oi oi-briefcase"></span> &nbsp; '.$eventInst;
  }

  echo $html;

  ?>


</div>
