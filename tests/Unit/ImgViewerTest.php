<?php

namespace Tests\Unit;

use App\Services\ImgViewer;
use Tests\TestCase;

class ImgViewerTest extends TestCase
{
    /** @var ImgViewer */
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(ImgViewer::class);
    }

    public function testSuccess()
    {
        $img = $this->service->random();
        $this->assertContains($img, ['test/img/01.jpg', 'test/img/02.jpg']);
    }
}
