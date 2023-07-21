<?php

namespace App\Console;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $oneYearAgo = Carbon::now()->subYear();

        Post::whereDoesntHave('comments', function ($query) use ($oneYearAgo) {
            $query->where('created_at', '>', $oneYearAgo);
        })->delete();
    })->daily();
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
