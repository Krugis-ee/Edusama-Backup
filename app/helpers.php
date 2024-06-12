<?php
if(!function_exists('daycount'))
{
function daycount($day, $startdate,$enddate, $counter)
{
    if($startdate >= $enddate)
    {
        return $counter;
    }
    else
    {
        return daycount($day, strtotime("next ".$day, $startdate),$enddate, ++$counter);
    }
}
}				?>