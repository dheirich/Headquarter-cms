<?php

namespace Tests\Feature;

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
        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
