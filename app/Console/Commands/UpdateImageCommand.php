<?php

namespace App\Console\Commands;

use App\Models\Music;
use App\Services\MasterService;
use App\Services\MusicService;
use Illuminate\Console\Command;

class UpdateImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $musicService;
    protected $masterService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MusicService $musicService, MasterService $masterService)
    {
        $this->musicService = $musicService;
        $this->masterService = $masterService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start Update image');

        $bgr = $this->masterService->getAllImage()->pluck('url')->toArray();
        $count = count($bgr) ;
//        dd(random_int(0, $count - 1));
        $songs = Music::query()->whereNull('image')->orWhere('image', '')->get();
        foreach ($songs as $song) {
            $bg = $bgr[random_int(0, $count - 1)];
            $song->image = $bg;
            $song->save();
        }

        $this->info('End Update image');
    }
}
