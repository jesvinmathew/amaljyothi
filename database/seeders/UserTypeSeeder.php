<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserType;
use DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        UserType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        UserType::create([
            "name" => "Document Uploader"
         ]);

        UserType::create([
            "name" => "Document Downloader"
         ]);
    }
}
