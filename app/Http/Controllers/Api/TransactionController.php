<?php

namespace App\Http\Controllers\Api;

use App\Dto\TransactionInputDto;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionService;
use Illuminate\Http\{
    Request,
    Response
};
use Illuminate\Validation\ValidationException;
use Throwable;
class TransactionController extends Controller
{
    public function __construct(
        private TransactionService $transactionService
    ) {
    }

    public function transaction(Request $request)
    {
        try {
            $request->validate([
                'payment_method' => ['required', 'string'],
                'account_id' => ['required', 'integer'],
                'transaction_value' => ['required', 'numeric']
            ]);

            $transactionInputDto = new TransactionInputDto(
                accountId: $request->account_id,
                paymentMethod: $request->payment_method,
                transactionValue: $request->transaction_value
            );

            $this->transactionService->execute($transactionInputDto);

            return response()->json(['ok'], Response::HTTP_CREATED);
        } catch (ValidationException $validationException) {
            return response()->json(
                ['message' => $validationException->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        } catch (NotFoundException $notFoundException) {
            return response()->json(
                ['message' => $notFoundException->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        } catch (Throwable $t) {
            return response()->json(['message' => $t->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
