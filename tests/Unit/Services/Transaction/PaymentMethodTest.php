<?php

namespace Tests\Unit\Services\Transaction;

use App\Enums\PaymentMethodsEnum;
use App\Exceptions\NotFoundException;
use App\Services\Transaction\{
    PaymentMethod,
    PaymentMethods\Credit,
    PaymentMethods\Debit,
    PaymentMethods\Pix
};
use PHPUnit\Framework\TestCase;
use Throwable;

class PaymentMethodTest extends TestCase
{
    /**
     * @dataProvider paymentMethodProvider
     */
    public function testMethod(
        string $paymentMethodInput,
        $expected
    ) {
        $paymentMethod = new PaymentMethod();
        $method = $paymentMethod->method($paymentMethodInput);

        $this->assertInstanceOf($expected, $method);
    }

    public function testMethodNotFound()
    {
        try {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->method('Z');
            $this->assertTrue(false);
        } catch (Throwable $throwable) {
            $this->assertInstanceOf(NotFoundException::class, $throwable);
        }
    }

    public static function paymentMethodProvider()
    {
        return [
            'Pix Transaction' => [PaymentMethodsEnum::PIX, Pix::class],
            'Debit Transaction' => [PaymentMethodsEnum::DEBIT, Debit::class],
            'Credit Transaction' => [PaymentMethodsEnum::CREDIT, Credit::class]
        ];
    }
}
