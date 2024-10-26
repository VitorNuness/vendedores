<?php

namespace Feature\Http\Controllers\ProfileController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanGetAuthenticatedUserWithSuccess(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)
            ->getJson(route('profile.show'));

        // Assert
        $response->assertOk();
        $response->assertJsonPath('id', $user->id);
        $response->assertJsonPath('name', $user->name);
        $response->assertJsonPath('email', $user->email);
        $response->assertJsonPath('created_at', $user->created_at->toDateTimeString());
        $response->assertJsonPath('updated_at', $user->updated_at->toDateTimeString());
    }
}
