<?php

namespace Tests\Feature\Http\Controllers\AuthenticationController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanLogoutWithSuccess(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $this->actingAs($user);
        $response = $this->getJson(route("auth.logout"));

        // Assert
        $response->assertNoContent();
        $this->getJson(route("auth.logout"))->assertUnauthorized();
    }

    public function testOnlyAuthenticatedUsersCanLogout(): void
    {
        // Act
        $response = $this->getJson(route("auth.logout"));

        // Assert
        $response->assertUnauthorized();
    }
}
