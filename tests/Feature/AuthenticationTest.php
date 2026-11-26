<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_guest_is_redirected_from_dashboard(): void
    {
        // Arrange
        $this->assertGuest();
        // Act
        $response = $this->get('/dashboard');
        // Assert
        $response->assertStatus(302);
    }
}
