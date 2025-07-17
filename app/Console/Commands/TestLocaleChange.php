<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class TestLocaleChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-locale-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test locale change functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testando il cambio lingua...');
        
        // Test lingua italiana
        Session::put('locale', 'it');
        App::setLocale('it');
        $this->info('Lingua corrente: ' . App::getLocale());
        $this->info('Traduzione test: ' . __('statistics.title'));
        
        // Test lingua inglese
        Session::put('locale', 'en');
        App::setLocale('en');
        $this->info('Lingua corrente: ' . App::getLocale());
        $this->info('Traduzione test: ' . __('statistics.title'));
        
        // Test lingua tedesca
        Session::put('locale', 'de');
        App::setLocale('de');
        $this->info('Lingua corrente: ' . App::getLocale());
        $this->info('Traduzione test: ' . __('statistics.title'));
        
        // Test lingua francese
        Session::put('locale', 'fr');
        App::setLocale('fr');
        $this->info('Lingua corrente: ' . App::getLocale());
        $this->info('Traduzione test: ' . __('statistics.title'));
        
        $this->info('Test completato!');
    }
}
