<?php

namespace Tests\Feature\Http\Controllers\AuthenticationController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanRegisterANewUser(): void
    {
        // Arrange
        $newUser = [
            "name"     => fake()->name,
            "email"    => fake()->email,
            "password" => fake()->password,
        ];

        // Act
        $response = $this->postJson(route("auth.store"), $newUser);

        // Assert
        $response->assertOk();
        $this->assertDatabaseHas("users", [
            'id'    => 1,
            'name'  => $newUser['name'],
            'email' => $newUser['email'],
        ]);
        $response->assertJsonPath('token', fn (?string $token) => strlen($token) > 0);
    }

    public function testCantRegisterANewUser(): void
    {
        // Act
        $response = $this->postJson(route("auth.store"));

        // Assert
        $response->assertUnprocessable();
        $this->assertDatabaseCount("users", 0);
    }

    public function testRequiredFields()
    {
        // Act
        $response = $this->postJson(route("auth.store"));

        // Assert
        $response->assertUnprocessable();
        $response->assertInvalid([
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);
    }

    public function testUniqueFields()
    {
        // Arrange
        $user    = User::factory()->create();
        $request = [
            'name'     => fake()->name,
            'email'    => $user->email,
            'password' => fake()->password,
        ];

        // Act
        $response = $this->postJson(route("auth.store"), $request);

        // Assert
        $response->assertUnprocessable();
        $response->assertInvalid([
            'email' => 'The email has already been taken.',
        ]);
    }
}
