<?php

namespace Tests\Unit;

use App\Services\UrlShortener;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @var UrlShortener */
    private $service;
    private $faker;

    protected function setUp(): void
    {
        $this->service = app(UrlShortener::class);
        parent::setUp();
    }

    public function successProvider()
    {
        $faker = Factory::create();

        return [
            [$faker->url, $faker->name, Carbon::tomorrow(), true],
            [$faker->url, $faker->name, Carbon::tomorrow(), false],
            [$faker->url, $faker->name, null, true],
            [$faker->url, $faker->name, null, false],
            [$faker->url, null, null, false],
        ];
    }

    /**
     * @dataProvider successProvider
     * @param string $url
     * @param string|null $short
     * @param Carbon|null $expire
     * @param bool $commercial
     */
    public function testSuccess(string $url, ?string $short, ?Carbon $expire, bool $commercial)
    {
        $saved = $this->service->encode($request = [
            'url'        => $url,
            'short'      => $short,
            'expire'     => $expire,
            'commercial' => $commercial,
        ]);

        $this->assertEquals($url, $saved->url, 'Expected saved url is equals to passed one');
        $this->assertEquals($expire, $saved->expire_at);
        $this->assertEquals($commercial, $saved->is_commercial);
        $this->assertDatabaseHas('urls', ['id' => $saved->id]);

        if ($short) {
            $this->assertEquals($short, $saved->short_url);
        }
    }

    public function testNoUrl()
    {
        $this->expectException(\Exception::class);
        $this->service->encode($request = [
            'url'        => null,
            'short'      => null,
            'expire'     => null,
            'commercial' => null,
        ]);
    }
}
