<?php
/*
All rights to the Yandex geocoder belong to Yandex N.V. (https://yandex.ru/company/)
*/

class yanGeoHelp {
  private $inLoc;
  private $inAddress;
  private $coord;
  private $fullAddress;
  private $formattedAddress;
  private $country;
  private $administrativeArea;
  private $subAdministrativeArea;
  private $city;
  private $street;
  private $house;
  private $key;

  public function setLoc($param) {
    $this->inLoc = $param;
    $this->geocodeCoords();
  }

  public function setAddress($param) {
    $this->inAddress = $param;
    $this->geocodeAddress();
  }

  public function setKey($param) {
    $this->key = $param;
  }

  public function getCoords() {
    if($this->coord) {
      return $this->coord;
    }
  }

  public function getFullAddress() {
    if($this->fullAddress) {
      return $this->fullAddress;
    }
  }

  public function getFormattedAddress() {
    if($this->formattedAddress) {
      return $this->formattedAddress;
    }
  }

  public function getCountry() {
    if($this->country) {
      return $this->country;
    }
  }

  public function getAdministrativeArea() {
    if($this->administrativeArea) {
      return $this->administrativeArea;
    }
  }

  public function getSubAdministrativeArea() {
    if($this->subAdministrativeArea) {
      return $this->subAdministrativeArea;
    }
  }

  public function getCity() {
    if($this->city) {
      return $this->city;
    }
  }

  public function getStreet() {
    if($this->street) {
      return $this->street;
    }
  }

  public function getHouse() {
    if($this->house) {
      return $this->house;
    }
  }

  private function geocodeCoords() {
    if (strpos($this->inLoc, ',') !== false) {
      $arrayCoord = explode(',', $this->inLoc);
      $coord = $arrayCoord[1] . ' ' .  $arrayCoord[0];
    } else {
      $coord = $this->inLoc;
    };
    if ($this->key) {
      $checkedKey = $this->key;
    } else {
      $checkedKey = '...';
    };
    $params = array(
      'geocode' => $coord,
      'format' => 'json',
      'results' => 1,
      'key' => '$checkedKey',
    );
    $response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
    if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0) {
        $this->fullAddress = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->text;
        $this->formattedAddress = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->Address->formatted;
        $this->country = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->CountryName;
        $this->administrativeArea = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName;
        $this->subAdministrativeArea = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
        $this->city = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->LocalityName;
        $this->street = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
        $this->house = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->Premise->PremiseNumber;
        $nonFCoo = explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
        $this->coord = $nonFCoo[1] . ', ' . $nonFCoo[0];
    };
  }

  private function geocodeAddress() {
    if ($this->key) {
      $checkedKey = $this->key;
    } else {
      $checkedKey = $checkedKey;
    };
    $params = array(
      'geocode' => $this->inAddress,
      'format' => 'json',
      'results' => 1,
      'key' => '...',
    );
    $response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
    if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0) {
        $this->fullAddress = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->text;
        $this->formattedAddress = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->Address->formatted;
        $this->country = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->CountryName;
        $this->administrativeArea = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName;
        $this->subAdministrativeArea = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
        $this->city = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->LocalityName;
        $this->street = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
        $this->house = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->Premise->PremiseNumber;
        $nonFCoo = explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
        $this->coord = $nonFCoo[1] . ', ' . $nonFCoo[0];
    };
  }
}
?>