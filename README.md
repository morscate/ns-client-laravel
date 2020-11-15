# NS client for Laravel
A Laravel library to consume the Nederlandse Spoorwegen (Dutch Railways) API.

## Resources
The architecture of the resources is inspired by Laravel's Eloquent models.

### Finding a trips
````
use Morscate\NSClient\Resources\Trip;

$trips = Trip::originUicCode(8400561)
            ->destinationStation(8002084)
            ->departureDateTime('2020-11-05T12:26:14+00:00')
            ->get();
````