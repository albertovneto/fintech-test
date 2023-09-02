<?php

namespace App\Http\Controllers\Api;

use App\Dto\AccountWalletCreateInputDto;
use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\AccountWalletCreateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $accountService,
        protected AccountWalletCreateService $accountWalletCreateService
    ) {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $accountWalletCreateDto = new AccountWalletCreateInputDto($request->balance);
            $accountWalletCreated = $this->accountWalletCreateService->execute($accountWalletCreateDto);

            return response()->json($accountWalletCreated->toArray(), 201);
        } catch(Throwable $t) {
            return response()->json($t->getMessage(), 500);
        }
    }

    public function getById(Request $request): JsonResponse
    {
        $account = $this->accountService->getByAccountId($request->id);
        return response()->json($account->toArray());
    }
}
