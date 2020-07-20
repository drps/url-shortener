<?php

namespace App\Dto;

use App\Entities\Url;

class UrlHit
{
    private $url;
    private $img;

    public function __construct(Url $url, ?string $img = null)
    {
        $this->url = $url;
        $this->img = $img;
    }

    public function getUrl(): Url
    {
        return $this->url;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }
}
