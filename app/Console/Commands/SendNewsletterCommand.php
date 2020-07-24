<?php

namespace App\Console\Commands;

use App\Notifications\NewsletterNotification;
use App\User;
use Illuminate\Console\Command;

class SendNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter {emails?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo electronico';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = $this->argument('emails');
        $builder =  User::query();

        //solucion de reto
        // $builder
        //     ->whereNull('email_verified_at')
        //     ->whereRaw('email_verified_at BETWEEN DATE_ADD(CURDATE(), INTERVAL -7 DAY) AND CURDATE()');

        if ($emails) {
            $builder->whereIn("email", $emails);
        }

        $count = $builder->count();

        if ($count) {
            $this->output->progressStart($count);

            $builder->whereNotNull('email_verified_at')
                ->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });

            $this->output->progressFinish();
            $this->info("Se enviaron {$count} correos");
        }
        $this->info('No se envio ningun correo');
    }
}