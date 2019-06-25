# Temper onboarding retention curve

## Pre-requisites

- composer (https://getcomposer.org/)
- PHP >= 7.1.3

## Set up instructions

After cloning this application, run the start script (this command: `./start.sh`) in a terminal.
This script will install all dependencies using composer, run the migration and then start your php server

## Demo

If all goes well, visit http://localhost:8000, you should see a page with already set start and end dates.
Feel free to change the dates or just hit the **generate** button.
You should see this graph
![Alt text](img.png?raw=true "Demo")

## Testing

To test this, run `vendor/bin/phpunit` in the root folder in a terminal.
If all goes well, you should see 
```
OK (8 tests, 9 assertions)
```

## License

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

This solution is built with the Laravel framework.
The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
