<?php

namespace App\Console\Commands;

use App\Models\Music;
use App\Models\Song;
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
    protected $signature = 'command:update_description';

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
       $songs = Song::query()->get();
       foreach ($songs as $song) {
           $title = str_replace('- vietmix.vn', '', $song->title);
           $song->description = __('description.content', ['song_title' => $title]);
           $oldLiked = $song->view;
           $oldView = $song->liked;
           if ($song->view < $song->liked) {
               $song->liked = $oldView;
               $song->view = $oldLiked;
           }
           $song->save();
       }
    }
}
