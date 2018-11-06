<?php

namespace App;

use App\Location;
use Carbon\Carbon;

class Helper
{
    /**
    * Convert date to dutch format
    *
    * @param  string  $date
    * @param  string  $format
    * @param  string  $value
    */
    public static function parseDateFormat($date, string $format = 'd-m-Y', $no_value = '-')
    {
        if (isset($date) && $date != '-') {
          return Carbon::parse($date)->format($format);
        } else {
          return $no_value;
        }
    }

    /**
    * Convert status to text
    *
    * @param  string  $status
    */
    public static function setStatusText(string $status)
    {
        switch ($status) {
          case 1:
            return 'Actief';
            break;

          case 0:
            return 'Inactief';
            break;

          default:
            return '-';
            break;
        }
    }

    /**
    * Get locations
    *
    * @param  string  $date
    */
    public static function getProjectTypes()
    {
        $types = [
          'default' => 'Selecteer een locatie',
          'neutraal' => 'Neutraal',
          'brandgevaarlijk' => 'Brandgevaarlijk',
          'corrosief' => 'Corrosief',
          'combo' => 'Brand + Corrosief',
        ];

        return $types;
    }

    /**
    * Get locations
    *
    */
    public static function getLocations($default = true)
    {
        $default_txt = $default ? ['default' => 'Selecteer een locatie'] : [];

        $locations = $default_txt + Location::get()->pluck('name', 'id')->toArray();

        return $locations;
    }

}
