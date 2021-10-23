<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AggregateTraffic extends Model
{
    use HasFactory;

    public function scopeFromLastWeek(Builder $query)
    {
        $today = now()->format('Y-m-d');
        $startDate = now()->subWeek()->format('Y-m-d');
        return $query->whereBetween('date', [$startDate . ' 00:00:00', $today . ' 23:59:59']);
    }

    public function scopeFromLastMonth(Builder $query)
    {
        $today = now()->format('Y-m-d');
        $startDate  = now()->subMonth()->format('Y-m-d');
        return $query->whereBetween('date', [$startDate . " 00:00:00", $today . " 23:59:59"]);
    }
}