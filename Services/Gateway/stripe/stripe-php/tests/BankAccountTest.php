<?php

declare(strict_types=1);

namespace StripeJS;

class BankAccountTest extends TestCase
{
    public function testVerify(): void
    {
        self::authorizeFromEnv();

        $customer = self::createTestCustomer();

        $bankAccount = $customer->sources->create([
            'source' => [
                'object' => 'bank_account',
                'account_holder_type' => 'individual',
                'account_number' => '000123456789',
                'account_holder_name' => 'John Doe',
                'routing_number' => '110000000',
                'country' => 'US',
            ],
        ]);

        static::assertSame($bankAccount->status, 'new');

        $bankAccount = $bankAccount->verify([
            'amounts' => [32, 45],
        ]);

        static::assertSame($bankAccount->status, 'verified');
    }
}
