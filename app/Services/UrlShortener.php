<?php

namespace App\Services;

use App\Entities\Url;
use App\Http\Requests\EncodeRequest;
use Illuminate\Support\Facades\DB;

class UrlShortener
{
    private $baseEncoder;

    public function __construct(BaseEncoder $baseEncoder)
    {
        $this->baseEncoder = $baseEncoder;
    }

    public function encode(array $request): Url
    {
        $this->assertShortLink($request['short'] ?? null);

        return DB::transaction(function () use ($request) {
            // @todo move to nextId
            $urlModel = new Url();
            $urlModel->url = $request['url'] ?? null;
            $urlModel->short_url = $request['short'] ?? null;
            $urlModel->expire_at = $request['expire'] ?? null;
            $urlModel->is_commercial = $request['commercial'] ?? false;

            $urlModel->saveOrFail();

            if (!$urlModel->short_url) {
                $time = $this->baseEncoder->encode(time());
                $urlModel->short_url = $time . $this->baseEncoder->encode($urlModel->id);
                $urlModel->saveOrFail();
            }

            return $urlModel;
        });
    }

    private function assertShortLink(?string $link)
    {
        if ($link && Url::where('short_url', $link)->exists()) {
            throw new \DomainException('Link already exists.');
        }
    }
}
