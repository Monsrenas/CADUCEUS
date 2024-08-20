<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Swift_SmtpTransport;
use App\Mail\NtlmSmtpTransport;

class NtlmMailServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend('swift.transport', function ($service, $app) {
            return new class($app['config']['mail']) extends \Illuminate\Mail\TransportManager {
                protected function createSmtpDriver()
                {
                    $config = $this->app['config']->get('mail.mailers.smtp', []);

                    return new NtlmSmtpTransport(
                        $config['host'],
                        $config['username'],
                        $config['password'],
                        'Exchange2010' // O la versión de Exchange que estés utilizando
                    );
                }
            };
        });
    }
}
