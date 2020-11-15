# NS client for Laravel
A Laravel library to consume the Nederlandse Spoorwegen (Dutch Railways) API.

## Installation
````
composer require morscate/ns-client-laravel
````
````
php artisan vendor:publish --provider="Morscate\NsClient\NsClientServiceProvider"
````
### Configuration
1. Create an account on: https://apiportal.ns.nl. <br />
2. Login in and go to: https://apiportal.ns.nl/developer. <br />
3. From there copy the Primaire sleutel (primary key) and paste it in the config or in the .env file.

## Resources
The architecture of the resources is inspired by Laravel's Eloquent models.

### Finding trips
````
use Morscate\NSClient\Resources\Trip;

$trips = Trip::originUicCode(8400561)
            ->destinationStation(8002084)
            ->departureDateTime('2020-11-05T12:26:14+00:00')
            ->get();
````