<?php

namespace Database\Seeders;

use App\Models\satting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        satting::create([
            'email'=>'contact@skillshub.com',
            'phone'=>'01012345679',
            'facebook'=>'https://www.facebook.com',
            'twitter'=>'https://www.twitter.com',
            'instagram'=>'https://www.instagram.com',
            'youtube'=>'https://www.youtube.com',
            'linkedin'=>'https://www.linkedin.com',
        ]);
    }
}
