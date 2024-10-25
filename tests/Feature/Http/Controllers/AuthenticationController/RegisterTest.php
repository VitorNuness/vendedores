<?php

namespace Tests\Feature\Http\Controllers\AuthenticationController;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $response->assertJson(fn (AssertableJson $json) => $json->has("data.message.token"));

        $this->assertDatabaseHas("sellers", [
            'id'    => 1,
            'name'  => $newUser['name'],
            'email' => $newUser['email'],
        ]);
    }
}
