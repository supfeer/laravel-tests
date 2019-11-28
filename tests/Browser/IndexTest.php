<?php

namespace Tests\Browser;

use Tests\Browser\Pages\VideoMainPage;
use Tests\Browser\Pages\VideoSearchResultPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IndexTest extends DuskTestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->browse(function (Browser $browser) {
            $browser->visit(new VideoMainPage())
                ->waitForPageLoad();
        });
    }

    public function testVideoPreviewOnHover()
    {
        $this->browse(function (Browser $browser) {
            $query = 'ураган';

            $browser->on(new VideoMainPage())
                ->findVideoByText($query)
                ->on(new VideoSearchResultPage())
                ->waitForPageLoad();
            $browser->hoverVideoPreview()
                ->assertVideoPreviewIsPlaying();

        });
    }
}
