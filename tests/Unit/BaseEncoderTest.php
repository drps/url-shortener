<?php

namespace Tests\Unit;

use App\Services\BaseEncoder;
use PHPUnit\Framework\TestCase;

class BaseEncoderTest extends TestCase
{
    /** @var BaseEncoder */
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(BaseEncoder::class);
    }

    /**
     * @dataProvider data
     * @param int $id
     * @param string $answer
     */
    public function testSuccess(int $id, string $answer)
    {
        $str = $this->service->encode($id);
        $this->assertEquals($str, $answer);
    }

    public function data()
    {
        return [
            [0, ''],
            [1, 'b'],
            [61, '9'],
            [62, 'ba'],
            [63, 'bb'],
        ];
    }
}
