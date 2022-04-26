<?php 
date_default_timezone_set("America/Argentina/Cordoba"); 
setlocale(LC_TIME, 'spanish');

class DateManager
{
    // Returns today but with date function.
   public static function Today()
   {
       return date("Y/m/d");
   }

   // Returns the today date with time. Uses getdate
   public static function TodayWithTime()
   {
       $date = getdate();

       return $date["mday"] . "-" . $date["mon"] . "-" . $date["year"] . " " . 
       $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"];
   }

   // Deprecated to return the formatted time.
   public static function TodayFormatted()
   {
       return strftime("%d-%m-%Y", time());
   }

   // Shows difference in days before a date.
   public static function DaysBeforeDate($date)
   {
      $now = strtotime("now");
      $diff = strtotime($date) - $now;
      $diffInDays = intval($diff/86400);
      return $diffInDays;
   }

   public static function LocalTime()
   {
      $localTime = localtime(time(),1);
      var_dump($localTime);
   }
}
echo "Hoy es: " . DateManager::Today() . "<br/>";
echo "La fecha y hora es: " . DateManager::TodayWithTime() . "<br/>";
//echo "Formateado: " . DateManager::TodayFormatted();
echo "La diferencia en dias hasta la fecha 30-04-2022 es: " . DateManager::DaysBeforeDate("30 April 2022") . "<br/>";
echo "La diferencia en dias hasta la fecha 21-04-2022 es: " . DateManager::DaysBeforeDate("21 April 2022") . "<br/>";
echo DateManager::LocalTime();
?>