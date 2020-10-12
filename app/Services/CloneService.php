<?php


namespace App\Services;


use App\Http\Helpers\Helper;
use App\Models\Music;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpClient\HttpClient;

class CloneService
{

    /**
     * Clone link music form site nhacdj.vn
     *
     * @param $urlClone
     * @param $category
     */
    public function cloneFromNhacDj($urlClone, $category)
    {
        try {
            $client = new Client(HttpClient::create(['timeout' => 60]));
            $crawler = $client->request('GET', $urlClone);

            $crawler->filter('.song-name > h3 > a')->each(function ($note) use ($category) {
                $link = $note->attr('href');
                $musicName = $note->text();
                $musicName = explode( ' - ', $musicName);
                if (count($musicName) > 1) {
                    for($i = 0; $i < count($musicName); $i++) {
                        if ($i == count($musicName) - 1) {
                            unset($musicName[$i]);
                        }
                    }
                }

                $musicName = implode(" ", $musicName) . ' [vietmix.vn]';

                $song = Music::where('link_clone', $link)->first();
                if (is_null($song)) {
                    $song = new Music();
                    $song->name = $musicName;
                    $song->link_clone = $link;
                    $song->master_category_id = $category->id;
                    $song->link = Str::slug($musicName);
                    $song->view = random_int(20000, 589000);
                    $song->uuid = Helper::getUuid();
                    $song->save();
                }
            });
        } catch (\Exception $exception) {
            dd($exception);
        }

    }

    public function cloneMp3FormNhacDj($client, $music, $currentDay)
    {
        try {
            $client = new Client(HttpClient::create(['timeout' => 60]));
            $crawler = $client->request('GET', $music->link_clone);
            $urlAudio = $crawler->filter('#media-player > audio > source')->each(function ($node) use ($music, $currentDay) {
                $urlMp3 = $node->attr('src');
                if (!empty($urlMp3)) {
                    $music->link_mp3 = $urlMp3;
                    $music->link_updated_at = Carbon::now();
                    $music->save();
                    Cache::put("music_". $music->id, $urlMp3, Carbon::now()->endOfDay());
                }
                return $urlMp3;
            });
            return count($urlAudio) > 0 ? head($urlAudio) : '';
        }catch (\Exception $exception) {
            dd($exception);
        }
    }
}
