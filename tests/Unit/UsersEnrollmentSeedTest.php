<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class UsersEnrollmentSeedTest extends TestCase
{
    public function testCreateEnrollment()
    {
        $status = ['in progress', 'complete'];

        for($i = 1; $i <= 100; $i++) {

            $data = [
                'user_id' => random_int(1, 50),
                'course_id' => random_int(1, 50),
                "status_now" => $status[random_int(0, 1)]
            ];
            
            $response = $this->post('/api/enrollment', $data);

            $response->assertStatus(200);

        }
    }

    public function testGetEnrollmentList()
    {
        $response = $this->get('/api/enrollment');

        $response->assertStatus(200);

    }

    public function testGetEnrollmentById()
    {
        for($i = 1; $i <= 50; $i++) {
            
            $response = $this->get('/api/enrollment/' . $i);

            $response->assertStatus(200);

        }
    }

    public function testUpdateEnrollment()
    {
        $status = ['in progress', 'complete'];

        for($i = 1; $i <= 50; $i++) {

            $data = [
                "status" => $status[random_int(0, 1)]
            ];
            
            $response = $this->patch('/api/enrollment/' . $i, $data);

            $response->assertStatus(200);

        }
    }
}
