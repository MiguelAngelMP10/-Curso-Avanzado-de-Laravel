<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\NewsletterNotification;

class SendEmailVerificationReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo electronico a los usuarios que no han verificado su cuenta despues de haberse registraod hace una semana';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        //solucion de reto
        // $builder
        //     ->whereNull('email_verified_at')
        //     ->whereRaw('email_verified_at BETWEEN DATE_ADD(CURDATE(), INTERVAL -7 DAY) AND CURDATE()');
        User::query()
            ->whereDate('created_at', '=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->whereNull('email_verified_at')
            ->each(function (User $user) {
                // Equivalente a $this->notify(new NewsletterNotification);
                $user->sendEmailVerificationNotification();
            });
    }
}