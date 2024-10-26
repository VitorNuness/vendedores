<?php

namespace Feature\Http\Controllers\ProfileController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanGetUpdateProfileNameWithSuccess(): void
    {
        // Arrange
        $user    = User::factory()->create();
        $newName = 'John Doe Updated';

        // Act
        $response = $this->actingAs($user)
            ->putJson(route('profile.update'), [
                'name' => $newName,
            ]);

        // Assert
        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id'   => $user->id,
            'name' => $newName,
        ]);
        $response->assertJsonPath('id', $user->id);
        $response->assertJsonPath('name', $newName);
        $response->assertJsonPath('email', $user->email);
        $response->assertJsonPath('created_at', $user->created_at->toDateTimeString());
        $response->assertJsonPath('updated_at', now()->toDateTimeString());
    }

    public function testNameIsRequired(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)
            ->putJson(route('profile.update'), [
                'name' => '',
            ]);

        // Assert
        $response->assertInvalid([
            'name' => 'required',
        ]);
    }
}
