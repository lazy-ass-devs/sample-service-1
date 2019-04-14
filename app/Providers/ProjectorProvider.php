<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Projectors\MainProjector;

class ProjectorProvider extends ServiceProvider {
    /**
     *
     * @var App/Projectors/Projector
     */
    private $projectors = [
        'App\Projectors\Projector\HelloProjector', 
        'App\Projectors\Projector\WorldProjector',
        'App\Projectors\Projector\SampleEventProjector'
    ];

    public function register(){
        $this->app->bind('App\Projectors\MainProjector', function (){
            $mainProjector = new MainProjector();
            foreach($this->projectors as $projector){
                $mainProjector->setProjector(new $projector());
            }
            return $mainProjector;
        });
    }
}