<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class UsersEnrollmentSeedTest extends TestCase
{
    public function testCreate()
    {
        $status = ['in progress', 'complete'];

        for($i = 0; $i < 100; $i++) {

            // Arrange
            $data = [
                'user_id' => random_int(1, 50),
                'course_id' => random_int(1, 50),
                "status_now" => $status[random_int(0, 1)]
            ];
            
            // Act
            $response = $this->post('/api/enrollment', $data);

            // Assert
            $response->assertStatus(200);


        }
    }
}
