<?php

namespace Tests\Unit;

use App\Models\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * Test fillable attributes.
     */
    public function test_customer_has_fillable_attributes(): void
    {
        $customer = new Customer();
        $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'address',
            'total_points',
            'membership_level',
        ];
        
        $this->assertEquals($fillable, $customer->getFillable());
    }

    public function test_customer_casts(): void
    {
        $customer = new Customer();
        $casts = $customer->getCasts();
        
        $this->assertEquals('integer', $casts['total_points']);
    }

    public function test_customer_membership_checks(): void
    {
        $customer = new Customer();
        
        $customer->membership_level = Customer::MEMBERSHIP_REGULAR;
        $this->assertTrue($customer->isRegular());
        
        $customer->membership_level = Customer::MEMBERSHIP_SILVER;
        $this->assertTrue($customer->isSilver());
        
        $customer->membership_level = Customer::MEMBERSHIP_GOLD;
        $this->assertTrue($customer->isGold());
        
        $customer->membership_level = Customer::MEMBERSHIP_PLATINUM;
        $this->assertTrue($customer->isPlatinum());
    }
}
