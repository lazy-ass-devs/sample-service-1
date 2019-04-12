# Sample Service 1

## Getting Started
Sample service built in lumen. For now, this is the receiver. see [sample-service-2](https://github.com/lazy-ass-devs/sample-service-2) for the publisher example

### Prerequisites

What things you need to install the software and how to install them
* lumen
* composer
* RabbitMQ

### Installing

copy the repository 
```
git clone
```

install all the dependencies
```
composer install
```

## Running the tests

Run the event listener
```
php artisan event:listen
```
![Event Listen](samples/1.png)

After that... make sure to send the [sample-service-2](https://github.com/lazy-ass-devs/sample-service-2) project and see the changes
![Event Listen2](samples/2.png)

## How to Laravel Way
Create a artisan command and make it listen to incoming RabbitMQ queues
https://laravel.com/docs/5.8/artisan#writing-commands

Check the [**app/Console/Commands/EventListener.php**, **app/Console/Kernel.php**] files for the implementation.
