# IFR Alternate Airport Helper

This is a simple tool I created that can map alternate airports which have an instrument approach within a certain radius. There are currently a few limitations, and this should not be used for real-world navigation.

## Getting started

### Install the web application

This project is built on top of the Laravel PHP framework. It's requirements can be found [here](https://laravel.com/docs/5.7/installation#server-requirements).

``` bash
git clone https://github.com/andydeforest/ifr-alternate-airport-helper.git && cd ifr-alternate-airport-helper.git
composer install
```

Once the composer dependencies are installed, you'll want to install the front-end dependencies

``` bash
npm install && npm run dev
```

Next, you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root and update the appropriate database variables.

Run the following command to seed airport data

```
php artisan migrate:refresh --seed
```

Then start your server:

```
php artisan serve
```

The project should now be running!

## Limitations

Currently, I use the data that is freely available to parse from the FAA's 28-day NASR subscription (the same data found in the chart supplement). As far as I know, there is nothing that explicitly states whether an airport has no approach, a non-precision approach, or a precision approach, so I'm relying on the section for runway markings to determine the approaches available. For example, PIR indicates that the runway has precision instrument markings and NPI indicates non-precision instrument markings. This works well for most airports, but there are still some fields that have a non-precision approach without the appropriate markings, so they won't show up on the map.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details