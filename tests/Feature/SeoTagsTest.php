<?php

namespace Tests\Unit;

use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;
use Tests\Unit\Util\CsvFileIterator;

class SeoTagsTest extends TestCase
{
    const SEO_FILE_CSV = '/var/www/tests/Feature/resources/seoTags.csv';
    const COOKIE       = 'test=seo';

    /**
     * @dataProvider seoTagsProvider
     */
    public function testSeoTagsExistsIfCookie(string $url, string $meta, string $title, string $description): void
    {
        $page = new Crawler(
            $this->get($url, ['cookie' => self::COOKIE])
                ->assertOk()
                ->content()
        );

        $this->assertTitleText($page, $title);
        $this->assertMetadataExists($page, $meta);
        $this->assertDescriptionText($page, $description);
    }

    /**
     * Provides tests data sets
     *
     * @return CsvFileIterator
     */
    public function seoTagsProvider()
    {
        return new CsvFileIterator(self::SEO_FILE_CSV);
    }

    /**
     * Check if metadata exists on page
     *
     * @param Crawler $page
     * @param string $expectedMetadata
     */
    private function assertMetadataExists(Crawler $page, string $expectedMetadata): void
    {
        $expectedCountMetadata = 1;
        $actualCountMetadata   = $page
            ->filterXPath("//meta[@" . $expectedMetadata . "]")
            ->count();

        $this->assertEquals(
            $expectedCountMetadata,
            $actualCountMetadata,
            'Expected ' . $expectedCountMetadata . ' occurrence meta with attribute ' . $expectedMetadata . ' but was ' . $actualCountMetadata . ' occurrences'
        );
    }


    /**
     * Check attribute content in meta name="description"
     *
     * @param Crawler $page
     * @param string $expectedDescription
     */
    private function assertDescriptionText(Crawler $page, string $expectedDescription): void
    {
        $actualDescription = $page->filterXPath("//meta[@name=\"description\"]")
            ->first()
            ->attr('content');

        $this->assertEquals(
            $expectedDescription,
            $actualDescription,
            'Expected description ' . $expectedDescription . ' but was ' . $actualDescription
        );
    }

    /**
     * Check tag title
     *
     * @param Crawler $page
     * @param string $expectedTitle
     */
    private function assertTitleText(Crawler $page, string $expectedTitle): void
    {
        $actualTitle = $page->filterXPath("//title")
            ->first()
            ->text();

        $this->assertEquals(
            $expectedTitle,
            $actualTitle,
            'Expected title is ' . $expectedTitle . ' but was ' . $actualTitle
        );
    }
}
