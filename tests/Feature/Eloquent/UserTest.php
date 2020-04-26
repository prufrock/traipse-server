<?php

namespace Tests\Feature\Eloquent;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public function testFindUserThatDoesntExistReturnsNothing()
    {
        $this->assertNull(User::find(99999));
    }
    
    public function testFindUserThatDoesExistReturnsTheUser()
    {
        $user = factory(User::class)->create();
        
        $this->assertEquals($user->name, User::find($user->id)->name);
    }
    
    public function testAUserCanHaveAGroup()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        
        $user->groups()->attach($group->id);
        
        $this->assertEquals($group->id, $user->groups()->first()->id);
    }
}
