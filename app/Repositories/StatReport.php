<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StatReport
{
    public function recent(int $days = 14)
    {
        $sql = <<<SQL
            SELECT u.*,t.ip,t.cnt 
            FROM urls u
            JOIN (
                SELECT url_id, ip, count(*) cnt from stat
                WHERE created_at >= now() - interval :days day
                GROUP BY url_id, ip    
            ) t ON t.url_id = u.id
SQL;

        return DB::select(DB::raw($sql), [
            'days' => $days,
        ]);
    }
}
