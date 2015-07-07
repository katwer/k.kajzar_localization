<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-04
 */

namespace Lib;

class GoogleMapsApi
{

    public function __construct()
    {
        
    }

    // function to geocode address, it will return false if unable to geocode address
    public static function geocode($address)
    {

        // url encode the address
        $address = urlencode($address);

        // google map geocode api url
        $url = "http://DDDDmaps.google.com/maps/api/geocode/json?sensor=false&address={$address}";

        // get the json response
        $resp_json = file_get_contents($url);
        if(!$resp_json) {
            throw new \Exception('Could not open connect to Google Maps API.');
        }

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {

            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];

            // verify if data is complete
            if ($lati && $longi && $formatted_address) {

                // put the data in the array
                $data = array(
                    'lat' => $lati,
                    'lng' => $longi,
                    'address' => $formatted_address,
                    'status' => $resp['status'],
                );


                return $data;
            } else {
                return false;
            }
        } else {
            return $resp;
        }
    }

}
