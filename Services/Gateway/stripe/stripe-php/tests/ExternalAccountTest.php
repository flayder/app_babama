<?php

declare(strict_types=1);

namespace StripeJS;

class ExternalAccountTest extends TestCase
{
    public function testVerify(): void
    {
        self::authorizeFromEnv();
        $bankAccountToken = Token::create(
            [
                'bank_account' => [
                'country' => 'US',
                'routing_number' => '110000000',
                'account_number' => '000123456789',
                'account_holder_name' => 'Jane Austen',
                'account_holder_type' => 'company',
                ],
            ]
        );
        $customer = Customer::create();
        $externalAccount = $customer->sources->create(['bank_account' => $bankAccountToken->id]);
        $verifiedAccount = $externalAccount->verify(['amounts' => [32, 45]], null);

        $base = Customer::classUrl();
        $parentExtn = $externalAccount['customer'];
        $extn = $externalAccount['id'];
        static::assertEquals("$base/$parentExtn/sources/$extn", $externalAccount->instanceUrl());
    }
}
