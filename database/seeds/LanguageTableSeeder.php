<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            ['name' => 'English','description' => '{\r\n    \"Email\": \"Email\"\r\n}','code'=>'en','status'=>1,'created_at' => Carbon::now(),'updated_at' => Carbon::now()]
        ]);
    }
}
