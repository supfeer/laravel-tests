<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;
use Tests\Browser\Components\SearchBoxComponent;

class VideoMainPage extends Page
{
    use SearchBoxComponent;

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'https://yandex.ru/video';
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
        $browser->waitFor($this->inputSearchBox);
    }
}
