<?php

use Illuminate\Database\Seeder;

class CatchableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CatchableSeeder::class)->create();
    }
}
