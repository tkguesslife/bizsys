<?php
namespace AppBundle\Services\Utils;

/**
 * Class SAIDNumberUtil
 * @author Tiko Banyini
 */
class SAIDNumberUtil
{


    /**
     * @param $id
     * @return bool
     * @author Tiko Banyini
     */
    public static function validate($id)
    {

        if (strlen($id) != 13 || !is_numeric($id)) {
            return false;
        }

        try {


            $match = preg_match("!^(\d{2})(\d{2})(\d{2})\d{7}$!", $id, $matches);
            if (!$match) {
                return false;
            }

            list (, $year, $month, $day) = $matches;

            /**
             * Check that the date is valid
             */
            if (!checkdate($month, $day, $year)) {
                return false;
            }
            $parts = str_split($id);
//        $odds = " $parts[0] $parts[2] $parts[4] $parts[6] $parts[8] $parts[10]";
            $a = $parts[0] + $parts[2] + $parts[4] + $parts[6] + $parts[8] + $parts[10];
//        $evens=  "$parts[1] $parts[3] $parts[5] $parts[7] $parts[9] $parts[11]";
            $b = $parts[1] . $parts[3] . $parts[5] . $parts[7] . $parts[9] . $parts[11];
            $bMultiplied = $b * 2;
            $partsMultiplied = str_split($bMultiplied);
            $c = 0;
            for ($i = 0; $i < count($partsMultiplied); $i++) {
                $c += $partsMultiplied[$i];
            }
            $d = $a + $c;
            $dParts = str_split($d);
            $e = 10 - $dParts[1];
            if ($e == $parts[12]) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }

        return false;
    }


}