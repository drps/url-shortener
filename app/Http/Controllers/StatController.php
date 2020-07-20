<?php

namespace App\Http\Controllers;

use App\Entities\Stat;
use App\Entities\Url;
use App\Repositories\StatReport;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class StatController extends BaseController
{
    use ValidatesRequests;

    private $stats;

    public function __construct(StatReport $stats)
    {
        $this->stats = $stats;
    }

    public function statAll()
    {
        return view('stat-all', [
            'stats' => $this->stats->recent(),
        ]);
    }

    public function stat(Url $url)
    {
        $query = Stat::forUrl($url)->orderByDesc('created_at');

        return view('stat', [
            'stats' => $query->paginate(5),
        ]);
    }
}
