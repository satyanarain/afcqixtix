<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ETMLoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('POST', 'api/v1/login', [
    		'username' => 242424,
    		'password' => 123456,
            'etm_id' => 123321,
            'gprs_level' => 5,
            'battery_percentage' => 80
    	]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'statusCode' => 'Ok',
            ]);
    }
}
