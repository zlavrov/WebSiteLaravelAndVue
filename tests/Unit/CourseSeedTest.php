<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class CourseSeedTest extends TestCase
{
    public function testCreateCourse()
    {
        for($i = 1; $i <= 50; $i++) {

            $data = [
                'title' => Str::random()
            ];
            
            $response = $this->post('/api/course', $data);

            $response->assertStatus(200);
        }
    }

    public function testGetCourseList()
    {       
        $response = $this->get('/api/course');

        $response->assertStatus(200);

    }

    public function testGetCourseById()
    {
        for($i = 1; $i <= 50; $i++) {
            
            $response = $this->get('/api/course/' . $i);

            $response->assertStatus(200);

        }
    }

    public function testUpdateCourse()
    {
        for($i = 1; $i <= 50; $i++) {

            $data = [
                'title' => Str::random()
            ];
            
            $response = $this->patch('/api/course/' . $i, $data);

            $response->assertStatus(200);

        }
    }
}
