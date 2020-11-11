<?php

namespace App\Imports;

use App\Http\Helpers\Helper;
use App\Song;
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
        $description = "Nghe và tải nhac $title tại vietmix.vn";
        $listTags = [
            'nonstop', 'remix', 'dj', 'china mix', 'mashup', 'edm',
        ];

        $args = explode('-', $file);

        return new Song([
            'title'             => $title,
            'author'            => 'hhh',
            'slug'              => $slug,
            'image'             => '',
            'file_name'         => $file,
            'keyword'           => '',
            'url'               => $file,
            'category_id'       => $categoryId,
            'description'       => $description,
            'is_set_link'       => 0,
            'view'              => random_int(40000, 376899),
            'liked'             => random_int(40000, 376899),
        ]);
    }
}
