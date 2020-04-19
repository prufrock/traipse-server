<?php

namespace Tests\Feature\Eloquent;

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
}
