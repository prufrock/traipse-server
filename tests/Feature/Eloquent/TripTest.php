<?php

namespace Tests\Feature\Eloquent;

use App\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;
    
    public function testFindUserThatDoesntExistReturnsNothing()
    {
        $this->assertNull(Trip::find(99999));
    }
    
    public function testFindUserThatDoesExistReturnsTheUser()
    {
        $trip = factory(Trip::class)->create(['name' => 'Adventure!']);
        
        $this->assertEquals($trip->name, Trip::find($trip->id)->name);
    }
}
