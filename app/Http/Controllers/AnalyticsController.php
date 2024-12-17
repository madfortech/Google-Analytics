<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Gtmassey\LaravelAnalytics\Request\Dimensions;
use Gtmassey\LaravelAnalytics\Request\Metrics;
use Gtmassey\LaravelAnalytics\Analytics;
use Gtmassey\Period\Period;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function activeUsers()
{
    $report = Analytics::query()
        ->setMetrics(fn(Metrics $metrics) => $metrics
            ->active1DayUsers()
            ->active7DayUsers()
            ->active28DayUsers()
        )
        ->forPeriod(Period::defaultPeriod())
        ->run();

    return view('analytics.index', compact('report'));
}

public function pageViewsByPageTitle()
{
    $report = Analytics::query()
        ->setMetrics(fn(Metrics $metrics) => $metrics->sessions())
        ->setDimensions(fn(Dimensions $dimensions) => $dimensions->pageTitle())
        ->forPeriod(Period::create(Carbon::now()->subDays(30), Carbon::now()))
        ->run();

    return view('analytics.index', compact('report'));
}
}
