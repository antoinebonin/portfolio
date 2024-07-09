<?php

namespace Database\Seeders;

use App\Enum\PageStatutEnum;
use App\Models\Page;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Antoine',
            'email' => 'bonin.antoine@proton.me',
        ]);

        Page::create([
            'title' => "Accueil",
            'url' => '',
            'description' => "Page d'accueil",
            'blocs' => [],
            'statut' => PageStatutEnum::PUBLISH
        ]);
    }
}
