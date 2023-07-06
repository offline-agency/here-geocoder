<?php

namespace Thiagoprz\HereGeocoder\Test;

use JsonSchema\Validator;
use Thiagoprz\HereGeocoder\HereGeocoder;

class HereGeocoderFunctionTest extends TestCase
{
  public function testGeocodeReturnIsValid()
  {
    $address_data = $this->hereGeocoder->geocode('Champ de Mars, 5 Avenue Anatole France, 75007 Paris');
    $expected_json_schema = file_get_contents( __DIR__ . '/here-geocoder-schema.json');

    // Validate the geocoded address data against the JSON schema
    $validator = new Validator();
    //$address_data = json_encode($address_data);
    //dd($address_data);
    $validator->validate($address_data, json_decode($expected_json_schema));

    // Assert that the validation passes
    $this->assertTrue($validator->isValid(), 'Geocoded address data is valid according to the schema');
    $this->assertTrue(true);
  }
}
