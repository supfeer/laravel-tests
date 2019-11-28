<?php

namespace Tests;


use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverDimension;

use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;


/**
 * Each browser test class should extend this
 *
 * Class DuskTestCase
 * @package Tests
 */
abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        static::startChromeDriver();
    }

    public static function tearDownAfterClass()
    {
        static::stopChromeDriver();
        parent::tearDownAfterClass();
    }

    public function setUp()
    {
        parent::setUp();

        Browser::$baseUrl = 'http://yandex.ru';
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = null;

        if (env('CHROME_HEADLESS_MODE_DISABLED')) {
            $options = (new ChromeOptions)->addArguments([
                '--lang=ru',
                '--window-size=1366,1020',
            ]);
        } else {
            $options = (new ChromeOptions)->addArguments([
                '--lang=ru',
                '--disable-gpu',
                '--headless',
                '--window-size=1366,1020',
            ]);
        }

        return RemoteWebDriver::create(
            'http://chrome:4444/wd/hub', DesiredCapabilities::chrome()
                ->setCapability(ChromeOptions::CAPABILITY, $options)
        );
    }

    /**
     * Configuring to capture failure screenshots for each browser.
     *
     * @param $browsers
     */
    protected function captureFailuresFor($browsers)
    {
        $browsers->each(function (Browser $browser, $key) {
            $browser->driver->manage()->window()->setSize(new WebDriverDimension(1366, 2000));
            $browser->screenshot($this->getName() . '-' . $key);
        });
    }
}
