<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;

class RollbackNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Note::truncate();
    }
}
