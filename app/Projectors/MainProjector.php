<?php

namespace App\Projectors;

final class MainProjector {
    /**
     * @var Projector
     */
    private $projectors;

    /**
     *
     * @param Projector $projector
     * @return void
     */
    public function setProjector(Projector $projector){
        $this->projectors [] = $projector;
    }

    /**
     *
     * @return void
     */
    public function getProjectors(){
        return $this->projectors;
    }
}