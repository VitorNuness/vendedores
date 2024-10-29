<?php

namespace Feature\Http\Controllers\SaleController;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use DatabaseMigrations;

    public function testStoreAnUserOrderWithSuccess(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Action
        $response = $this->actingAs($user)
            ->postJson(route('sale.store'), [
                'amount' => 1000_00,
            ]);

        // Assert
        $response->assertCreated();

        $this->assertDatabaseHas('sales', [
            'owner_id'   => $user->id,
            'amount'     => 100000,
            'commission' => 850,
        ]);
    }

    public function testAmountMustBeRequired(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Action
        $response = $this->actingAs($user)
            ->postJson(route('sale.store'), [
                'amount' => null,
            ]);

        // Assert
        $response->assertInvalid([
            'amount' => 'required',
        ]);
    }

    public function testAmountMinValueIsOne(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Action
        $response = $this->actingAs($user)
            ->postJson(route('sale.store'), [
                'amount' => 0,
            ]);

        // Assert
        $response->assertInvalid([
            'amount' => 'must be at least 1',
        ]);
    }

    public function testAmountMustBeInteger(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Action
        $response = $this->actingAs($user)
            ->postJson(route('sale.store'), [
                'amount' => 1.5,
            ]);

        // Assert
        $response->assertInvalid([
            'amount' => 'integer',
        ]);

    }
}
