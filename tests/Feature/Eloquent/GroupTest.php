<?php

namespace Tests\Feature\Eloquent;

use App\Group;
use App\Trip;
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
    
    public function testAGroupDoesNotHaveATripByDefault()
    {
        $group = factory(Group::class)->create(['name' => 'Together we Camp!']);
        
        $this->assertNull($group->trips()->first());
    }
    
    public function testAGroupCanHaveATripAssociatedWithIt()
    {
        $group = factory(Group::class)->create(['name' => 'Love to hike!']);
        
        $group->trips()->create(['name' => 'Muir Trail']);
        
        $this->assertEquals('Muir Trail', Trip::find($group->trips()->first())->first()->name);
    }
    
    public function testAGroupCanHaveManyTrips()
    {
        $group = factory(Group::class)->create(['name' => 'Love to hike!']);

        $group->trips()->create(['name' => 'Grassy Trail']);
        $group->trips()->create(['name' => 'Rocky Trail']);
        $group->trips()->create(['name' => 'Snowy Trail']);

        $this->assertEquals(3, $group->trips()->count());
    }
}
