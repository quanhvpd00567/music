<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Webpatser\Uuid\Uuid;

class ClearCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clear_cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $uuid = Uuid::generate(1, 'vietmix.vn', Uuid::compare(Carbon::now()->timestamp, 'quanhv'));
        dd($uuid->node);

        $uuid = Uuid::generate(5,'test', Uuid::NS_DNS);

        dd($uuid);
        dd( Uuid::generate(1,'00:11:22:33:44:55'));
//        $this->info('Start clear cache');
//        Artisan::call('cache:clear');
//        $this->info('End clear cache');
    }
}
