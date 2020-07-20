<?php

namespace App\Http\Controllers;

use App\Entities\Url;
use App\Http\Requests\EncodeRequest;
use App\Services\UrlShortener;
use App\Services\UrlViewer;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    private const SLEEP = 5;

    use ValidatesRequests;

    private $shortener;
    private $urlViewer;

    public function __construct(UrlShortener $shortener, UrlViewer $urlViewer)
    {
        $this->shortener = $shortener;
        $this->urlViewer = $urlViewer;
    }

    public function index()
    {
        return view('welcome');
    }

    public function encode(EncodeRequest $request)
    {
        $shortUrl = null;
        $request->flash();

        try {
            $shortUrl = $this->shortener->encode($request->post());
        } catch (\DomainException $e) {
            return back()->withErrors($e->getMessage());
        }

        $request->flush();

        return view('saved', [
            'shortUrl' => $shortUrl,
        ]);
    }

    public function visit(string $path)
    {
        /** @var Url $url */
        if (!$url = Url::active()->where('short_url', $path)->first()) {
            abort(404);
        }

        $dto = $this->urlViewer->hit($url, \Request::ip());

        if (!$dto->getImg()) {
            return redirect($url->url, 302);
        }

        return response(view('banner', [
            'src' => $dto->getImg(),
        ])->render())->header('refresh', self::SLEEP . ';url=' . $url->url);
    }
}
