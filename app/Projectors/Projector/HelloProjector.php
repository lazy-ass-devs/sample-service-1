<?php

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