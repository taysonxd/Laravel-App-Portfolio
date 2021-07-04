<?php

namespace App\Listeners;

use App\Events\ProjectSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OptimizeImage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProjectSaved  $event
     * @return void
     */
    public function handle(ProjectSaved $event)
    {           
        $image = Image::make( Storage::get("public/{$event->project->image}") )
                        ->widen(600)
                        ->limitColors(255)
                        ->encode();

        Storage::put("public/{$event->project->image}", (string) $image);
    }
}
