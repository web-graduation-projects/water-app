<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(User::class)]
class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $x = 'sd';
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'mobile' => $user->mobile,
        ]);
    }

    public function testGetFillableAttributes()
    {
        $marketplace = new User();

        $this->assertEquals(
            ['name', 'mobile', 'password'],
            $marketplace->getFillable()
        );
    }

    public function testGetHiddenAttributes()
    {
        $marketplace = new User();

        $this->assertEquals(
            ['password', 'remember_token'],
            $marketplace->getHidden()
        );
    }

    public function testCasts()
    {
        $user = new User();

        $this->assertEquals([
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
            'id' => 'int',
        ], $user->getCasts());
    }

    public function testAttributeCasting()
    {
        // Create a user with a castable attribute
        $user = User::factory()->create([
            'mobile_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        // Test that the attributes are cast correctly
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->mobile_verified_at);
        $this->assertNotEquals('password', $user->password); // Ensure the password is hashed
    }
}
