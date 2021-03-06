<?php

namespace Tests\Unit\Builders;

use App\Builders\Sites\JonbrobinsonSiteBuilder;
use App\Constants\HttpClientConstants;
use Tests\TestCase;


class JonbrobinsonBuilderTest extends TestCase
{

    public function testGetBaseUrl()
    {
        $builder = new JonbrobinsonSiteBuilder();

        $actual = $builder->getBaseUrl();
        $expected = "jonbrobinson.com";

        $this->assertEquals($expected, $actual);
    }

    public function testGetEndpoints()
    {
        $builder = new JonbrobinsonSiteBuilder();

        $actual = $builder->getEndpoints();

        $this->assertCount(2, $actual);
        $this->assertCount(1, $actual[HttpClientConstants::METHOD_GET]);
        $this->assertEmpty($actual[HttpClientConstants::METHOD_POST]);
    }

    public function testBuildSiteUrls()
    {
        $builder = new JonbrobinsonSiteBuilder();
        $builder->setUrls();

        $actual = $builder->getSite()->urls;

        $this->assertCount(2, $actual);
        $this->assertEquals('//jonbrobinson.com', $actual[0]['url']);
        $this->assertEquals('GET', $actual[0]['method']);
        $this->assertCount(2, $actual[0]);
    }

    public function testBuildSite()
    {
        $builder = new JonbrobinsonSiteBuilder();
        $builder->setName();
        $builder->setDescription();
        $builder->setBaseUrl();
        $builder->setEndpoints();
        $builder->setUrls();

        $site = $builder->getSite();

        $this->assertEquals('Jonbrobinson', $site->name);
        $this->assertEquals('jonbrobinson.com', $site->baseUrl);
        $this->assertCount(2, $site->endpoints);
    }
}