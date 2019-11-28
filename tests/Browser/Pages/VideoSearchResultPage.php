<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;
use Tests\Browser\Components\SearchBoxComponent;
use Tests\Browser\Components\VideoPreviewComponent;

class VideoSearchResultPage extends Page
{
    use SearchBoxComponent, VideoPreviewComponent;

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/video/search';
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [

        ];
    }

    /**
     * Wait for page load
     *
     * @param Browser $browser
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public function waitForPageLoad(Browser $browser)
    {
        $browser->waitFor($this->liVideoPreview);
    }

}
