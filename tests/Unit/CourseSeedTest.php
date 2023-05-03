<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class CourseSeedTest extends TestCase
{
    public function testCreate()
    {
        for($i = 0; $i < 50; $i++) {

            // Arrange
            $data = [
                'title' => Str::random()
            ];
            
            // Act
            $response = $this->post('/api/course', $data);

            // Assert
            $response->assertStatus(200);
        }
    }
}
