<?php

namespace App\Console\Commands;

use App\Models\MasterCategory;
use App\Models\MasterSite;
use App\Models\Music;
use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Services\CloneService;

class CloneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clone_link';

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
        $masterSites = MasterSite::where('status', MasterSite::$status['clone'])->where('is_run_batch', MasterSite::$batch['run'])
            ->with(['masterCategories' => function($q) {
                $q->where('is_run_batch', MasterSite::$batch['run']);
            }])
            ->get();

        if (count($masterSites) == 0) {
            return false;
        }

        $cloneService = new cloneService();

        foreach ($masterSites as $masterSite) {

            if (count($masterSite->masterCategories) > 0) {
                foreach ($masterSite->masterCategories as $category) {
                    $url = $masterSite->website . '/'. $category->category_clone;
                    if ($masterSite->website == Music::$website['nhac_dj_vn']) {
                        $this->info("$url: start");
                        $cloneService->cloneFromNhacDj($url, $category);
                        $this->info("$url: end");
                    }
                }
            }
        }
        return 0;
    }
}
