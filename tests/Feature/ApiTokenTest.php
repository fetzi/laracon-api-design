<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_send_forbidden_if_the_api_token_is_missing()
    {
        $response = $this->get('api/todos');
        $response->assertStatus(403);
    }

    /** @test */
    public function it_should_succeed_with_a_valid_api_token()
    {
        $response = $this->get('api/todos', ['api-token' => 'secret']);
        $response->assertStatus(200);
    }
}
