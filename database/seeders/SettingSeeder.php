<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $setting=   Setting::create([
            'language'=> 'English',
            'logo'=> 'logo.png',
            'favicon'=> 'favicon.png',
            'phone' => '+012681412' ,
            'email'=>'setting@gmail.com',
            'whatsapp' => '+02565432454',
            'facebook' => 'facebook@gmail.comm',
            'twitter' => 'twitter@gmail.comm',
            'instagram' =>'Instagram@gmail.comm',
            'youtube'=>'youtube@gmail.comm',
            'status' => '1'
        ]);

        DB::table('setting_translations')->insert([
            [
                'setting_id' => $setting->id,
                'locale' => 'en',
                'name' => 'My First setting',
                'description' => 'This is the content of my first setting.',
                'words_guide' => 'website settings',
                'about' => 'about',
                'privacy' => 'privacy',
                'terms' => 'terms',
            ],

            [
                'setting_id' => $setting->id,
                'locale' => 'ar',
                'name' => 'منشوري الأول',
                'description' => 'هذا هو محتوى منشوري الأول.',
                'words_guide' => 'إعدادات الموقع.',
                'about' => 'عن',
                'privacy' => 'الخصوصية',
                'terms' => 'شروط',


            ],
        ]);
    }
}