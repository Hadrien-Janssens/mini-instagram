<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // On supprime les anciennes images de test
        $images = Storage::disk('public')->files('images');
        Storage::disk('public')->delete($images);

        Post::factory()
            ->count(30)
            ->create();
    }
}