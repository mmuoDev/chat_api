<?php

namespace Tests\Feature;

use App\User;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;


class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    //asserts that a user can login
    public function testUserCanLogin()
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
        $user = factory(User::class)->create([
            'username' => 'testuser',
            'password' => bcrypt('password')
        ]);     
    
        $data = ['username' => 'testuser',
        'password' => 'password'];

        $this->json('POST', '/api/auth/login', $data)
            ->assertStatus(200);

    }  
}
