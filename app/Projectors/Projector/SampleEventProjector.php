<?php

namespace App\Projectors\Projector;

use App\Projectors\Projector;
use PhpAmqpLib\Message\AMQPMessage;

final class SampleEventProjector implements Projector {
    
    public function name() : string {
        return 'SampleEventProjector';
    }
    
    public function project($message): bool{
        if($message->event_name === 'SampleEvent'){
            return true;
        }
        return false;
    }
}