<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            ['name' => 'Customer','controller'=>'CustomerController'],
            ['name' => 'Staffs','controller'=>'StaffsController'],
            ['name' => 'Pages','controller'=>'PagesController'],
            ['name' => 'Email','controller'=>'EmailController'],
            ['name' => 'Banner','controller'=>'BannerController'],
            ['name' => 'Setting','controller'=>'SettingController'],
            ['name' => 'Job Area','controller'=>'ZoneController'],
            ['name' => 'Vehicles Types','controller'=>'TypeController'],
            ['name' => 'Vehicles Companies','controller'=>'MakeController'],
            ['name' => 'Vehicles Models','controller'=>'VehicleModelController'],
            ['name' => 'Faqs','controller'=>'FaqController'],
            ['name' => 'Categories','controller'=>'CategoryController'],
        ]);
    }
}
