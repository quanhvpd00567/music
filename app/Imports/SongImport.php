<?php

namespace App\Imports;

use App\Http\Helpers\Helper;
use App\Models\Song;
use hisorange\BrowserDetect\Exceptions\Exception;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class SongImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Song
    */
    public function model(array $row)
    {
        $title = $row[0];
        $file = $row[1];
        $categoryId = $row[2];
        $uuid = Helper::getUuid();
        $slug = Str::slug($row[0]). '-'. $uuid;
        $description = __('description.content', ['song_title' => $title]);

        $listTags = [
            'nonstop', 'remix', 'dj', 'china mix', 'mashup', 'edm',
        ];

        $args = explode('-', $file);

        $tag = [];
        foreach ($args as $item) {
            if (in_array($item, $listTags) && !in_array($item, $tag)) {
                array_push($tag, $item);
            }
        }

        if (count($tag) == 0 ) {
            $tag = ['vietmix.vn', 'vietmix', 'remix'];
        }

        $tag = implode(', ', $tag);

        return new Song([
            'title'             => $title,
            'author'            => $row[4] ?? 'vietmix dj',
            'slug'              => $slug,
            'image'             => 'https://media.vietmix.vn/' . $row[3],
            'file_name'         => $file,
            'keyword'           => $row[5],
            'url'               => $file,
            'category_id'       => $categoryId,
            'description'       => $description,
            'status'            => 0,
            'uuid'              => $uuid,
            'is_set_link'       => 0,
            'view'              => random_int(80000, 376899),
            'liked'             => random_int(40000, 80000),
        ]);
    }
}
