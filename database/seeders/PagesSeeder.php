<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'Bienvenue',
            'content' => 'Bienvenue'
        ]);
        Page::create([
            'title' => 'Avoir une consultation',
            'content' => 'Avoir une consultation'
        ]);
    }
}
