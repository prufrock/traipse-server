<?php

namespace Tests\Feature\GraphQL;

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

        $this->user = factory(\App\User::class)->create([
            'name' => 'Bessie Coleman',
            'api_token' => 'authenticate-me'
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
}
