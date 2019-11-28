<?php


namespace Tests\Browser\Components;


use Laravel\Dusk\Browser;

trait VideoPreviewComponent
{

    protected $liVideoPreview = '[role="listitem"]:nth-child(2)';

    public function hoverVideoPreview(Browser $browser)
    {
        $browser->mouseover($this->liVideoPreview)
            ->waitFor('.thumb-image_hovered');
    }

    public function assertVideoPreviewIsPlaying(Browser $browser)
    {
        $browser->waitFor($this->liVideoPreview . " .thumb-preview__target_playing");
        //TODO Some more assertions...
    }
}
