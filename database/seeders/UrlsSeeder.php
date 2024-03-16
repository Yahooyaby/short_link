<?php

namespace Database\Seeders;

use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UrlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $urls = [
            "https://habr.com/ru/companies/productivity_inside/articles/505430/",
            "https://ilavista.by/blog/voprosy-na-sobesedovanii-laravel",
            "https://slurm.io/blog/tpost/pnyjznpvr1-apache-kafka-osnovi-tehnologii",
            "https://www.ozon.ru/?att=1",
            "https://www.youtube.com/",
            "https://tproger.ru/translations/what-are-web-sockets"
        ];

        foreach ($urls as $url) {
            Url::create([
                'name' => Str::random('10'),
                'link' => $url,
                'short_link' => Str::random(7),
                'user_id' => random_int(1, User::query()->count())
            ]);
        }
    }
}
