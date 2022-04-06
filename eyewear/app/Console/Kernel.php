<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Admin_model\Admin;

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
    $schedules = Admin::where('admin_type','Admin')->first();

      if($schedules->admin_backup_option == "Yes"){
        $backup_schedule = $schedules->admin_backup_schedule;
         $schedule->command( 'backup:clean' )->$backup_schedule();
         $schedule->command( 'backup:run' )->$backup_schedule();
      }
      if($schedules->admin_sitemap_option == "Yes"){
       $sitemap_schedule = $schedules->admin_sitemap_schedule;
        $schedule->command('sitemap:generate')->$sitemap_schedule();
      }
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
