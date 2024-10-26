<?php

namespace Tests\Feature\Http\Controllers\AuthenticationController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanLoginWithSuccess(): void
    {
        // Arrange
        $userCredentials = [
            "email"    => fake()->email,
            "password" => fake()->password,
        ];
        $user = User::factory()->create($userCredentials);

        // Act
        $response = $this->postJson(route("auth.login"), $userCredentials);

        // Assert
        $response->assertOk();
        $response->assertJsonPath('token', fn (?string $token) => strlen($token) > 0);
    }
}
