<?php

namespace App\Services;

use App\Dto\UrlHit;
use App\Entities\Stat;
use App\Entities\Url;
use Psr\Log\LoggerInterface;

class UrlViewer
{
    private $imgViewer;
    private $logger;

    public function __construct(ImgViewer $imgViewer, LoggerInterface $logger)
    {
        $this->imgViewer = $imgViewer;
        $this->logger = $logger;
    }

    public function hit(Url $url, string $ip): UrlHit
    {
        $img = $url->is_commercial
            ? $this->imgViewer->random()
            : null;

        $this->stat($url, $ip, $img);

        return new UrlHit($url, $img);
    }

    private function stat(Url $url, string $ip, ?string $img = null)
    {
        try {
            $stat = Stat::make([
                'ip' => $ip,
                'img' => $img,
            ]);

            $stat->url()->associate($url);

            $stat->saveOrFail();
        } catch (\Exception|\Throwable $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }
}
