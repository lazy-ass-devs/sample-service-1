<?php

namespace App\Projectors\Projector;

use App\Projectors\Projector;
use PhpAmqpLib\Message\AMQPMessage;

final class HelloProjector implements Projector {
    
    public function name() : string {
        return 'HelloProjector';
    }
    
    public function project($message): bool{
        if($message->event_name === 'HelloEvent'){
            return true;
        }
        return false;
    }
}