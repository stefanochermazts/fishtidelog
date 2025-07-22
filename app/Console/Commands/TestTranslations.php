<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class TestTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test translations loading';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing translations...');
        
        // Test current locale
        $this->info('Current locale: ' . App::getLocale());
        $this->info('Config locale: ' . config('app.locale'));
        $this->info('Fallback locale: ' . config('app.fallback_locale'));
        
        // Test file existence
        $this->info('File exists (it): ' . (file_exists(base_path('lang/it/auth.php')) ? 'YES' : 'NO'));
        $this->info('File exists (en): ' . (file_exists(base_path('lang/en/auth.php')) ? 'YES' : 'NO'));
        
        // Test translation loading
        $this->info('Translation test (it): ' . __('auth.welcome_back'));
        $this->info('Translation test (en): ' . trans('auth.welcome_back', [], 'en'));
        
        // Test manual loading
        if (file_exists(base_path('lang/it/auth.php'))) {
            $translations = include base_path('lang/it/auth.php');
            $this->info('Manual load test: ' . ($translations['welcome_back'] ?? 'NOT FOUND'));
        }
        
        return 0;
    }
} 