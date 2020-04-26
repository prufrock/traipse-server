<?php

namespace Tests\Feature\Eloquent;

use App\Catchable;
use App\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatchableTest extends TestCase
{
    use RefreshDatabase;
    
    public function testFindUserThatDoesntExistReturnsNothing()
    {
        $this->assertNull(Catchable::find(99999));
    }
    
    public function testFindUserThatDoesExistReturnsTheUser()
    {
        $catchable = factory(Catchable::class)->create(['name' => 'Butterfly']);
        
        $this->assertEquals($catchable->name, Catchable::find($catchable->id)->name);
    }
}
