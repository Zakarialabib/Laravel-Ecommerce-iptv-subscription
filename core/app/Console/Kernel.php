<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Packageorder;
use App\Sale;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $packageSales = Sale::packages()->get();
            foreach ($packageSales as $key => $sale) {
                if($sale->packageOrder && $sale->packageOrder->start_date) {
                    $diff = Carbon::parse(Carbon::now())->diffInDays($sale->packageOrder->end_date, false);
                    Log::info($diff);
                    if($diff < 0) 
                    {
                        $sale->packageOrder()->update([
                            'package_status' => Packageorder::INACTIVE,
                        ]);
                    }
                    else if($diff < 7)
                    {
                        $sale->packageOrder()->update([
                            'package_status' => Packageorder::NEAR_END,
                        ]);
                    }
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
