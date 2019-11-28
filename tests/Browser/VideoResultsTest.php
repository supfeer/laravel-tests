<?php

namespace Tests\Browser;

use Tests\Browser\Pages\VideoMainPage;
use Tests\Browser\Pages\VideoSearchResultPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VideoResultsTest extends DuskTestCase
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
                ->findVideoByText($query);

            $browser->on(new VideoSearchResultPage())
                ->waitForPageLoad()
                ->hoverVideoPreview()
                ->assertVideoPreviewIsPlaying();

            $this->expectNotToPerformAssertions();
        });
    }
}
