<?php

namespace Tests\Feature\Eloquent;

use App\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;
    
    public function testFindUserThatDoesntExistReturnsNothing()
    {
        $this->assertNull(Group::find(99999));
    }
    
    public function testFindUserThatDoesExistReturnsTheUser()
    {
        $group = factory(Group::class)->create(['name' => 'Adventure!']);
        
        $this->assertEquals($group->name, Group::find($group->id)->name);
    }
}
