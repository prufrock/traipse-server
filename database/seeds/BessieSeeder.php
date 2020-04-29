<?php

use App\Group;
use App\User;
use Illuminate\Database\Seeder;

class BessieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user = factory(User::class)->create([
            'name' => 'Bessie Coleman',
            'api_token' => 'authenticate-me'
        ]);

        $group = factory(Group::class)->create([
            'name' => 'Stunt Pilot'
        ]);

        $this->user->groups()->attach($group);

        $group->trips()->create([
            'name' => 'Airshow'
        ]);
    }
}
