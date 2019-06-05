<?php
namespace App\Helpers;

/**
 * Class FormatHelper
 * Provides some functionality to simplify string formats and patterns on views.
 *
 * @package App\Helpers
 * @author  GeorgeShazkho<shazkho@gmail.com>
 * @version 0.3
 */
class FormatHelper {

    /*
     * 'RUT' (Chilean DNI) RELATED FUNCTIONS
     */

    /**
     * Makes a 'rut' number to look like most common used form (e.g. 12.345.678-9). Las digit in a 'rut'
     * is to verify rut's consistency, and will be dinamicaly calculated (must not provide it).
     *
     * @param   integer $rut    'Rut' number as stored in database (no dots, no dash).
     * @return  string  A string representation of the 'rut'.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function rut($rut)
    {
        $rut_temp = strrev($rut);
        $rut_array = str_split($rut_temp, 3);
        $rut_temp = implode(".", $rut_array);
        $rut_temp = strrev($rut_temp);
        return $rut_temp . '-' . self::get_dv($rut);
    }

    /**
     * Calculates verification digit of a 'rut'. It can be any digit (0-9) or a 'k' character.
     *
     * @param   integer     $rut    'Rut' number as stored in database (no dots, no dash).
     * @return  int|string  Verification digit to corresponding 'rut'.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function get_dv($rut)
    {
        $i = 2;
        $sum = 0;
        foreach(array_reverse(str_split($rut)) as $v) {
            if ($i == 8) {
                $i = 2;
            }
            $sum += $v * $i;
            ++$i;
        }
        $dvr = 11 - ($sum % 11);
        if($dvr == 11)
            return 0;
        if($dvr == 10)
            return 'K';
        return $dvr;
    }


    /*
     * DATE RELATED FUNCTIONS
     */

    /**
     * Formats any datetime string (in MySQL format) as an easy to read string to be shown on views.
     * Formatted datetime looks like: '01 de enero de 2010, a las 13:01'.
     *
     * @param   string  $raw_datetime   Raw datetime string exactly as retrieved from database.
     * @return  string  A string representation of any datetime string from database.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function datetime($raw_datetime)
    {
        if ($raw_datetime == null) {
            return "<i>No definida</i>";
        }
        $datetime_array = explode(' ', $raw_datetime);
        $format = "%s, a las %s";
        return sprintf(
            $format,
            self::date($datetime_array[0]),
            self::time($datetime_array[1]));
    }


    /**
     * Formats any date string (in MySQL format) as an easy to read string to be shown on views.
     * Formatted date looks like: '01 de enero de 2010'. It can also be used with a timestamp string.
     *
     * @param   string  $raw_date       Raw date string exactly as retrieved from database.
     * @param   bool    $fromTimestamp  No if using date string, Yes if using timestamp instead.
     * @return  string  A string representation of any date string from database.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function date($raw_date, $fromTimestamp=False)
    {
        if ($fromTimestamp) {
            $raw_date = explode(' ', $raw_date)[0];
        }
        $date_array = explode('-', $raw_date);
        $format = "%s de %s de %s";
        return sprintf(
            $format,
            self::clean_day($date_array[2]),
            self::month_to_string($date_array[1]),
            $date_array[0]);
    }


    /**
     * Formats any date string (in MySQL format) as an easy to read string to be shown on views,
     * with no year in it. Formatted date looks like: '01 de enero'. It can also be used
     * with a timestamp string.
     *
     * @param   string  $raw_date       Raw date string exactly as retrieved from database.
     * @param   bool    $fromTimestamp  No if using date string, Yes if using timestamp instead.
     * @return  string  A string representation of any date string from database, without indicating year.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function dateWithoutYear($raw_date, $fromTimestamp=false)
    {
        if ($fromTimestamp) {
            $raw_date = explode(' ', $raw_date)[0];
        }
        $date_array = explode('-', $raw_date);
        $format = "%s de %s";
        return sprintf(
            $format,
            self::clean_day($date_array[2]),
            self::month_to_string($date_array[1])
        );
    }


    /**
     * Formats any time string (in MySQL format) as an easy to read string to be shown on views.
     * Formatted time looks like: '13:01'. It can also be used with a timestamp string.
     *
     * @param   string  $raw_time       Raw time string exactly as retrieved from database.
     * @param   bool    $fromTimestamp  No if using time string, Yes if using timestamp instead.
     * @return  string  A string representation of any time string from database.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function time($raw_time, $fromTimestamp=false)
    {
        if ($fromTimestamp) {
            $raw_time = explode(' ', $raw_time)[1];
        }
        $time_array = explode(':', $raw_time);
        $format = "%s:%s";
        return sprintf($format, $time_array[0], $time_array[1]);
    }


    /**
     * Gets month name using month number. It is defined even though there's already a function that
     * makes the same because that function depends on correct timezone declaration (which is sometimes
     * hard to achieve because of server configuration, and will bge used in spanish.
     *
     * @param   integer $month  Month position in year.
     * @return  string  String with month name, in spanish.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function month_to_string($month)
    {
        $months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        if (!is_numeric($month) || $month < 1 || $month > count($months)) {
            return "DESCONOCIDO";
        }
        return $months[$month - 1];
    }


    /**
     * Creates a datetime string object from a date string separated by slashes, and returns it as a
     * datetime string in default unix format. As an example, the string 'DD/MM/YYYY' will produce
     * 'YYYY-MM-DD:0:00:00' (time set to 0).
     *
     * @param   string          $raw_date   Raw date string (separated by slashes).
     * @return  false|string    The result of datetime string creation. If it fails, returns false.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function datetime_from_date($raw_date)
    {
        $date_array = explode("/", $raw_date);
        $date = date_create($date_array[2] . "-" . $date_array[1] . "-" . $date_array[0]);
        return date_format($date, 'Y-m-d H:i:s');
    }


    /*
     * MONEY RELATED FUNCTIONS
     */

    /**
     * Formats a number as currency. It considers currency as shown on the following example:
     * '$ 12.345.678'
     *
     * @param   integer $amount The nominal value of desired currency string.
     * @return  string  String formatted as currency for defined amount.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    static function money($amount)
    {
        $amount_temp = strrev($amount);
        $amount_array = str_split($amount_temp, 3);
        $amount_temp = implode(".", $amount_array);
        $amount_temp = strrev($amount_temp);
        return "$ " . $amount_temp;
    }


    /*
     * PRIVATE FUNCTIONS
     */


    /**
     * Removes any zero (digit) from the beginning of a day sting. Using ir on '02' will produce '2'.
     *
     * @param   string  $day    A number (string) indicating the day to be cleaned.
     * @return  string  A string representation of the leaned day.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    private static function clean_day($day)
    {
        if (substr($day, 0, 1) == 0) {
            return substr($day, 1);
        }
        return $day;
    }

}
