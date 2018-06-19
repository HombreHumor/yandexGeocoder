# yandexGeocoderHelper
A helper class for working with the json-response of the Yandex geocoder.

## INSTALLATION
For this class to work, call it in the initialization file of your project as follows:
```php
require_once($PATH_TO_FILE . '/yaGeocoderHelper.php');
```
Or use Composer by setting the composer.json file to autoload this class.

## USAGE
This class allows you to get a complete list of geodata using the coordinates or address as input.
First, initialize the object:
```php
$someObj = new yanGeoHelp;
```
Then pass the input data to the object. It can be either coordinates (latitude, longitude):
```php
$someObj->setLoc(55.711157, 37.713985); // Send some coordinates of the point in Moscow
```
Either some address passed as a string:
```php
$someObj->setAddress('Rome, Lungotevere de Cenci'); 
```
After that you can use any of the following methods to get the data you need:

### getCoords()
```php
$someObj->getCoords(); // Getting the coordinates (latitude, longitude) 
```

### getFullAddress()
```php
$someObj->getFullAddress(); // Getting the full address (Country, region, city, street, house)
```

### getFormattedAddress()
```php
$someObj->getFormattedAddress(); // Getting formatted address (City, street, house) 
```

### getCountry()
```php
$someObj->getCountry(); // Getting country 
```

### getAdministrativeArea()
```php
$someObj->getAdministrativeArea(); // Getting administrative area 
```

### getSubAdministrativeArea()
```php
$someObj->getSubAdministrativeArea(); // Getting subadministrative area
```

### getCity()
```php
$someObj->getCity(); //Getting city
```

### getStreet()
```php
$someObj->getStreet(); // Getting street
```

### getHouse()
```php
$someObj->getHouse(); // Getting house
```

## Geocoder Yandex
All rights to the Yandex geocoder belong to Yandex N.V. (https://yandex.ru/company/). This class is intended for the convenience of using the products of the company "Yandex", using their open api source.