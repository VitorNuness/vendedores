<?php

namespace Feature\Http\Controllers\ProfileController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanDisableAnProfileWithSuccess(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)
            ->deleteJson(route('profile.destroy'));

        // Assert
        $response->assertNoContent();
        $this->assertSoftDeleted($user);
    }
}