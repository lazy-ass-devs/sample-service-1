<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

use App\Projectors\MainProjector;

class EventListener extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to event from ampq';

    /**
     * @var MainProjector
     */
    private $projectors;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MainProjector $mainProjector)
    {
        parent::__construct();

        $this->projectors = collect($mainProjector->getProjectors());
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generateProjector();
        $this->listenEventSubscriber();
    }

    private function generateProjector(){
        $projectors = $this->projectors->map(function($projector){
            return [$projector->name()];
        });
    
        $this->table(['Available Projectors'], $projectors);
    }

    private function listenEventSubscriber(){
        $this->line(" [*] Waiting for events. To exit press CTRL+C");

        $connection = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest');
        $channel = $connection->channel();

        $channel->exchange_declare('events', 'fanout', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

        $channel->queue_bind($queue_name, 'events');

        $channel->basic_consume($queue_name, '', false, true, false, false, $this->callback());

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function callback(){
        return function ($message){
            echo ' [x] ', $message->body, "\n";
        };

    }
}