<?php


namespace Tests\Browser\Components;


use Laravel\Dusk\Browser;

trait SearchBoxComponent
{
    protected $inputSearchBox   = '[aria-label="Запрос"]';
    protected $btnExecuteSearch = '.websearch-button__text';

    /**
     * Find video by text with search box
     *
     * @param Browser $browser
     * @param string $text
     * @return Browser
     */
    public function findVideoByText(Browser $browser, string $text): Browser
    {
        $browser->type($this->inputSearchBox, $text)
            ->click($this->btnExecuteSearch);

        return $browser;
    }
}
