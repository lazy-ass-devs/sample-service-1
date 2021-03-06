<?php

namespace App\Projectors\Projector;

use App\Projectors\Projector;
use PhpAmqpLib\Message\AMQPMessage;

final class WorldProjector implements Projector {
    
    public function name() : string {
        return 'WorldProjector';
    }
    
    public function project($message): bool{
        if($message->event_name === 'WorldEvent'){
            return true;
        }
        return false;
    }
}