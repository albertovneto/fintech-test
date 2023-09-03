<?php

namespace Tests\Feature\Api;

use App\Models\Account;
use App\Models\Wallet;
use Illuminate\Http\Response;
use Tests\TestCase;

class AccountApiTest extends TestCase
{
    public function testCreateAccount()
    {
        $request = [
            'balance' => 1,
        ];

        $response = $this->postJson('/api/account', $request);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['id', 'balance']);
    }

    public function testGetById()
    {
        $account = Account::factory()->create();
        Wallet::factory()->set('account_id', $account->id)->create();

        $response = $this->json('GET', "/api/account/$account->id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['id', 'balance']);
    }
}
