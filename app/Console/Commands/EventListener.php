<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest');
        $channel = $connection->channel();

        $channel->exchange_declare('events', 'fanout', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

        $channel->queue_bind($queue_name, 'events');

        echo " [*] Waiting for events. To exit press CTRL+C\n";

        $callback = function ($msg){
            echo ' [x] ', $msg->body, "\n";
        };

        $channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}