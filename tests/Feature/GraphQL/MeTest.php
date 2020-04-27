<?php

namespace Tests\Feature\GraphQL;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class MeTest extends TestCase
{
    use MakesGraphQLRequests;
    use RefreshDatabase;

    private $user;

    public function setUp(): void 
    {
       parent::setUp();

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
    
    public function testUnauthenticatedUserFailsToMakeRequestForMe()
    {
        $response = $this->postGraphQL(['query' => '
            query Me { 
               me { 
                   name
                  } 
               }
            '],
            ['Authorization' => 'Bearer dont-authenticate-me']
        );
        
        $this->assertStringStartsWith("{\"errors\":", $response->content());
        $response->assertStatus(200); // I do wish this returned a 400.
    }
    
    public function testAuthenticatedUserCanMakeARequestForMe()
    {
        $response = $this->postGraphQL(['query' => '
            query Me { 
               me { 
                   name
                  } 
               }
            '], 
            ['Authorization' => 'Bearer authenticate-me']
        )->assertJson([
            'data' => [
                'me' => [
                    'name' => $this->user->name
                ]
            ]
        ]);
    }
    
    public function testAnAuthenticedUserWithNoCollectiblesGetsAnEmptyList()
    {
        $response = $this->postGraphQL(['query' => '
            query Me { 
                 me { 
                     name
                     catchables {
                         id
                         name
                     } 
                }
           }
            '],
            ['Authorization' => 'Bearer authenticate-me']
        )->assertJson([
            'data' => [
                'me' => [
                    'name' => $this->user->name,
                    'catchables' => []
                ]
            ]
        ]);
    }

    public function testAnAuthenticedUserWithACatchableCanSeeIt()
    {
        $catchable = $this->user->catchables()->create([
            'name' => 'stunt plane model'
        ]);
        
        $response = $this->postGraphQL(['query' => '
            query Me { 
                 me { 
                     name
                     catchables {
                         id
                         name
                     } 
                }
           }
            '],
            ['Authorization' => 'Bearer authenticate-me']
        )->assertJson([
            'data' => [
                'me' => [
                    'name' => $this->user->name,
                    'catchables' => [
                        [
                            'id' => $catchable->id,
                            'name' => 'stunt plane model',
                        ]
                    ]
                ]
            ]
        ]);
    }
}
