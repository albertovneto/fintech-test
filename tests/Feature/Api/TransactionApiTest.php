<?php

namespace Tests\Feature\Api;

use App\Models\Account;
use App\Models\Wallet;
use Illuminate\Http\Response;
use Tests\TestCase;

class TransactionApiTest extends TestCase
{
    /**
     * @dataProvider transactionOkProvider
     */
    public function testTransaction(
        string $paymentMethod,
        float $transactionValue,
        float $balance
    ) {
        $account = Account::factory()->create();
        Wallet::factory()->set('account_id', $account->id)->set('balance', $balance)->create();

        $request = [
            'account_id' => $account->id,
            'payment_method' => $paymentMethod,
            'transaction_value' => $transactionValue,
        ];

        $response = $this->postJson('/api/transaction', $request);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['account_id', 'balance']);
    }

    /**
     * @dataProvider transactionInsufficientFundsProvider
     */
    public function testTransaction404(
        string $paymentMethod,
        float $transactionValue,
        float $balance
    ) {
        $account = Account::factory()->create();
        Wallet::factory()->set('account_id', $account->id)->set('balance', $balance)->create();

        $request = [
            'account_id' => $account->id,
            'payment_method' => $paymentMethod,
            'transaction_value' => $transactionValue,
        ];

        $response = $this->postJson('/api/transaction', $request);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public static function transactionOkProvider()
    {
        return [
            'Pix Transaction' => ['P', 45, 75.6],
            'Debit Transaction' => ['D', 40, 72.5],
            'Credit Transaction' => ['C', 35, 80],
        ];
    }

    public static function transactionInsufficientFundsProvider()
    {
        return [
            'Pix Transaction' => ['P', 75.6, 45],
            'Debit Transaction' => ['D', 72.5, 40],
            'Credit Transaction' => ['C', 80, 35],
        ];
    }
}
