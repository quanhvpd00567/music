<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

//use Storage
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:xxxx';

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
        Log::error('Isssss run');
        $url = Storage::disk('vietmix')->putFileAs('vietmix', public_path('robots.txt'), 'quan.txt');
//        $contents =  Storage::disk('vietmix')->url('uploads/h4yjnykpVnvcAy7YDYwHO6CCp5glynl4AIz51hZL.txt');
////        $url = Storage::url('file.jpg');
//        $url = Storage::disk('vietmix')->temporaryUrl(
//            'uploads/h4yjnykpVnvcAy7YDYwHO6CCp5glynl4AIz51hZL.txt', now()->addMinutes(5)
//        );

//        Storage
        return 0;
    }
}
