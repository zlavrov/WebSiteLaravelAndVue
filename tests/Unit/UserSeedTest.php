<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class UserSeedTest extends TestCase
{

    public function testCreateUser()
    {
        for($i = 1; $i <= 50; $i++) {

            $data = [
                'name' => Str::random(),
                'email' => Str::random().'@example.com'
            ];
            
            $response = $this->post('/api/user', $data);

            $response->assertStatus(200);

        }
    }

    public function testGetUserList()
    {
        $response = $this->get('/api/user');

        $response->assertStatus(200);

    }

    public function testGetUserById()
    {
        for($i = 1; $i <= 50; $i++) {
            
            $response = $this->get('/api/user/' . $i);

            $response->assertStatus(200);

        }
    }

    public function testUpdateUser()
    {
        for($i = 1; $i <= 50; $i++) {

            $data = [
                'name' => Str::random(),
                'email' => Str::random().'@example.com'
            ];
            
            $response = $this->patch('/api/user/' . $i, $data);

            $response->assertStatus(200);

        }
    }
}
