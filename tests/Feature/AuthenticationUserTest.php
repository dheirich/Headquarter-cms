<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthenticationUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        // Arrange
        $this->actingAs(User::factory()->make());
        // Act
        $response = $this->get('/dashboard');
        // Assert
        $response->assertStatus(200);
    }
}
