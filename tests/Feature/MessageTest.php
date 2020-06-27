<?php

namespace Tests\Feature;

use App\User;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;


class MessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    //asserts that a user can send messages
    public function testUserCanSendMessages()
    {
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        #logged on user
        $user = factory(User::class)->create([
            'username' => 'testuser',
            'password' => bcrypt('password')
        ]);     
        #test sender
        factory(User::class)->create([
            'username' => 'testreceiver',
            'password' => bcrypt('password')
        ]);  
        $data = [
            'receiver_username' => 'testreceiver',
            'message' => 'hello world'
        ];
        $this->actingAs($user, 'api');
        $this->json('POST', '/api/messages', $data)
        ->assertStatus(201);
    }  

    //asserts that a user can retrieve messages
    public function testAUserCanGetMessages(){
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        #logged on user
        $user = factory(User::class)->create([
            'username' => 'testuser',
            'password' => bcrypt('password')
        ]);     
        #test sender
        factory(User::class)->create([
            'username' => 'testreceiver',
            'password' => bcrypt('password')
        ]);  
        $data = [
            'receiver_username' => 'testreceiver',
            'message' => 'hello world'
        ];
        $this->actingAs($user, 'api');
        #asset message was sent
        $this->json('POST', '/api/messages', $data)
        ->assertStatus(201);
        #asset message was received
        $this->json('GET', '/api/messages', $data)
        ->assertStatus(200);
    }
}
