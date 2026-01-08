<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Test Fillable attributes.
     */
    public function test_user_has_fillable_attributes(): void
    {
        $user = new User();
        $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'role',
        ];
        
        $this->assertEquals($fillable, $user->getFillable());
    }

    /**
     * Test Casts attributes.
     */
    public function test_user_has_casts_attributes(): void
    {
        $user = new User();
        $casts = $user->getCasts();
        
        $this->assertArrayHasKey('email_verified_at', $casts);
        $this->assertArrayHasKey('password', $casts);
        $this->assertEquals('datetime', $casts['email_verified_at']);
        $this->assertEquals('hashed', $casts['password']);
    }

    public function test_user_roles(): void
    {
        $user = new User();
        
        $user->role = User::ROLE_SUPER_ADMIN;
        $this->assertTrue($user->isSuperAdmin());
        
        $user->role = User::ROLE_ADMIN;
        $this->assertTrue($user->isAdmin());
        
        $user->role = User::ROLE_OPERATOR;
        $this->assertTrue($user->isOperator());
    }
}
