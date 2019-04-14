<?php

namespace App\Projectors;

use PhpAmqpLib\Message\AMQPMessage;

interface Projector {
    /**
     * Name of the projector
     *
     * @return string
     */
    public function name(): string;
    /**
     * Handles the event from rabbitMQ
     *
     * @param [type] $msg
     * @return boolean
     */
    public function project($message): bool;
}