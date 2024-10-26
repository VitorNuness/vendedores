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

    public function testCantLoginWithInvalidEmail(): void
    {
        // Arrange
        $invalidCredentials = [
            "email"    => fake()->email,
            "password" => fake()->password,
        ];

        // Act
        $response = $this->postJson(route("auth.login"), $invalidCredentials);

        // Assert
        $response->assertUnprocessable();
    }

    public function testCantLoginWithInvalidPassword(): void
    {
        // Arrange
        $user          = User::factory()->create();
        $wrongPassword = [
            'email'    => $user->email,
            'password' => 'wrong password',
        ];

        // Act
        $response = $this->postJson(route("auth.login"), $wrongPassword);

        // Assert
        $response->assertUnauthorized();
    }

    public function testRequiredCredentials(): void
    {
        // Act
        $response = $this->postJson(route("auth.login"));

        // Assert
        $response->assertInvalid([
            'email'    => 'required',
            'password' => 'required',
        ]);
    }

    public function testEmailValidation(): void
    {
        // Arrange
        $credentials = [
            'email'    => 'aaa',
            'password' => fake()->password(),
        ];

        // Act
        $response = $this->postJson(route("auth.login"), $credentials);

        // Assert
        $response->assertInvalid([
            'email' => 'valid',
        ]);
    }

    public function testFailsWithMuchAttempts(): void
    {
        // Arrange
        $credentials = [
            'email'    => fake()->email(),
            'password' => fake()->password(),
        ];

        // Act
        $this->postJson(route("auth.login"), $credentials);
        $this->postJson(route("auth.login"), $credentials);
        $this->postJson(route("auth.login"), $credentials);
        $response = $this->postJson(route("auth.login"), $credentials);

        // Assert
        $response->assertTooManyRequests();
    }
}
