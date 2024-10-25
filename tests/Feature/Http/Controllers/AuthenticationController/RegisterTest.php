<?php

namespace Tests\Feature\Http\Controllers\AuthenticationController;

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
}
