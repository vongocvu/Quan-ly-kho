<?php 
   class FT_Date_Loader {
      function getCurentDate() {
            $date = getDate();
            $curentDate = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
            return $curentDate;
      }

      function getDateTime() {
         $date_time = date("Y-m-d") . ' ' . date("h:i:s");
           return $date_time;
      }
   }
?>