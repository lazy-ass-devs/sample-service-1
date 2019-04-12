# Sample Service 1

## Getting Started
Sample service built in lumen. For now, this is the receiver. see sample-service-2 for the publisher example

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
![Event Listen](/images/1.png)

After that... make sure to send the sample-service-2 project and see the changes
![Event Listen2](images/2.png)