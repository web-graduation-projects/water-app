<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Marketplace;
use App\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Marketplace::class)]
class MarketplaceModelTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateMarketplace()
    {
        $user = User::factory()->create();
        Marketplace::create([
            'name' => $name = $user->name,
            'mobile' => $mobile = $user->mobile,
            'user_id' => $user_id = $user->id,
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas('marketplaces', [
            'name' => $name,
            'mobile' => $mobile,
            'user_id' => $user_id,
        ]);
    }

    public function testMarketplaceBelongsTouser()
    {
        $user = User::factory()->create();
        $marketplace = Marketplace::create([
            'name' => 'Test Marketplace',
            'mobile' => '1234567890',
            'user_id' => $user->id,
            'password' => bcrypt('password'),
        ]);

        $this->assertTrue($marketplace->user->is($user));
    }

    public function testFillableAttributesFilled()
    {
        $marketplace = new Marketplace();

        $this->assertEquals(
            ['name', 'mobile', 'user_id', 'password'],
            $marketplace->getFillable()
        );
    }
}
