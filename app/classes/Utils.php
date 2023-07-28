<?php
class Utils
{
    public static function getDaysDifference(DateTime $targetDateTime, DateTime $currentDateTime)
    {
        $timeDifference = $currentDateTime->diff($targetDateTime);
        $totalDaysDifference = $timeDifference->days;
        return $totalDaysDifference;
    }
}
