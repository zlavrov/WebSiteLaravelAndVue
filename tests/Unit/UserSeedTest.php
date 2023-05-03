<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class UserSeedTest extends TestCase
{

    public function testCreate()
    {
        for($i = 0; $i < 50; $i++) {

            // Arrange
            $data = [
                'name' => Str::random(),
                'email' => Str::random().'@example.com'
            ];
            
            // Act
            $response = $this->post('/api/user', $data);

            // Assert
            $response->assertStatus(200);


        }
    }
}
