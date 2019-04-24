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

Run migration & seed
```
php artisan migrate --seed
```

## Running the tests

Run the event listener
```
php artisan event:listen
```
![Event Listen](samples/1.JPG)

After that... make sure to send the [sample-service-2](https://github.com/lazy-ass-devs/sample-service-2) project and see the changes
![Event Listen2](samples/2.JPG)

## How to Laravel Way
- Create a artisan command and make it listen to incoming RabbitMQ queues https://laravel.com/docs/5.8/artisan#writing-commands
    
    Check the [**app/Console/Commands/EventListener.php**, **app/Console/Kernel.php**] files for the implementation.

- Create Projector and add it into ProjectorProvider.

  1.) First create projector class and put it in **app\Projectors\Projector**     directory
  ```php
    namespace App\Projectors\Projector;
    
    use App\Projectors\Projector;
    use PhpAmqpLib\Message\AMQPMessage;
    
    final class HelloProjector implements Projector {
        
        public function name() : string {
            return 'HelloProjector';
        }
        
        public function project(AMQPMessage $message): bool{
            echo ' [x] ', $message->body, "\n";
            return true;
        }
    }
  ```

  2.) Navigate through ProjectProvider.php then add the namespace of class    HelloProjector
    ```php
    private $projectors = [
        'App\Projectors\Projector\HelloProjector'
    ];
    ```
    3.) Check, if its already binded. run **php artisan event:listen**
    ![Event Listen3](samples/3.JPG)
    
## Laravel Audit
Please use this tool for auditing the change log on eloquent model. This for the **Event Sourcing** of the application. www.laravel-auditing.com

Try to check the audits table. It should log the changes on what happen on the User eloquent during seed.

![Audit table](samples/lara-audit1.JPG)

For the implementation review the ff:
- [General Configuration](http://www.laravel-auditing.com/docs/9.0/general-configuration)
- [Auditable Configuration](http://www.laravel-auditing.com/docs/9.0/auditable-configuration)

See to it that we had implemented the Auditable trait which will be fire by Eloquent event (note: auditing wont work on query builder)
![Users](samples/lara-audit2.JPG)



