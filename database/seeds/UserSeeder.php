<?php

use App\Catchable;
use App\Group;
use App\Trip;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class, 1)->create(['api_token' => 'authenticate-me'])->first();
        $group = factory(Group::class)->create();
        $trip = factory(Trip::class)->create([
            'name' => 'Beach Island',
            'group_id' => $group->id
        ]);
        factory(Catchable::class)->create([
            'name' => 'Squid',
            'trip_id' => $trip->id
        ]);
        
        $user->groups()->attach($group);
    }
}
