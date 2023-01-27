<?php

namespace App\Console\Commands;

use App\Models\Tache;
use App\Notifications\TaskReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendTaskRemindersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task_reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send task reminder emails to users';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Log::info("Cron is working fine!");
        $taches =  Tache::with('user')
        ->where('reminder_at', '<=', now()->toDateTimeString())
        ->get();

        foreach ($taches as $tache){
            $tache->user->notify(new TaskReminderNotification($tache));
            $tache->update(['reminder_at' => NULL]);
        }

        return 0;
    }
}
