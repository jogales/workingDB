<?php

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Office::class,5)->create()->each(function ($office){
            $office->jobs()->save(factory(App\Job::class)->make());
        });
    }
}
