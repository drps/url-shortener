<?php

namespace Tests\Unit;

use App\Entities\Url;
use App\Services\UrlViewer;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UrlViewerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @var UrlViewer */
    private $service;
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(UrlViewer::class);
        $this->faker = Factory::create();
    }

    public function testCommercialSuccess()
    {
        /** @var Url $model */
        $model = factory(Url::class)->create(['is_commercial' => true]);
        $hit = $this->service->hit($model, $ip = $this->faker->ipv4);

        $this->assertNotEmpty($hit->getImg());
        $this->assertEquals($model, $hit->getUrl());
        $this->assertDatabaseHas('stat', [
            'url_id' => $model->id,
            'ip' => $ip,
            'img' => $hit->getImg(),
        ]);
    }

    public function testNonCommercialSuccess()
    {
        /** @var Url $model */
        $model = factory(Url::class)->create(['is_commercial' => false]);
        $hit = $this->service->hit($model, $ip = $this->faker->ipv4);

        $this->assertNull($hit->getImg());
        $this->assertEquals($model, $hit->getUrl());
        $this->assertDatabaseHas('stat', [
            'url_id' => $model->id,
            'ip' => $ip,
            'img' => null,
        ]);
    }
}
