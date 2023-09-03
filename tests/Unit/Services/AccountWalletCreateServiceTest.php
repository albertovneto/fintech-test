<?php

namespace Tests\Unit\Services;

use App\Services\{
    AccountService,
    AccountWalletCreateService,
    WalletService
};
use App\Dto\AccountWalletCreateInputDto;
use App\Dto\AccountWalletCreateOutputDto;
use App\Entities\AccountEntity;
use App\Entities\WalletEntity;
use PHPUnit\Framework\TestCase;
use Mockery;

class AccountWalletCreateServiceTest extends TestCase
{
    public function testExecute()
    {
        $balance = 50.8;
        $accountId = 1;
        $mockAccountService = Mockery::mock(AccountService::class);
        $mockWalletService = Mockery::mock(WalletService::class);
        $mockAccountServiceCreate = $mockAccountService;
        $mockWalletServiceCreate = $mockWalletService;

        $accountWalletInputDto = Mockery::mock(AccountWalletCreateInputDto::class, [
            $balance,
            null
        ]);

        $mockAccountEntity = Mockery::mock(AccountEntity::class, [
            $accountId
        ]);

        $mockAccountServiceCreate->shouldReceive('create')
            ->once()
            ->with($accountWalletInputDto)
            ->andReturn($mockAccountEntity);

        $mockWalletEntity = Mockery::mock(WalletEntity::class, [
            $accountId,
            2,
            $balance
        ]);

        $mockWalletServiceCreate->shouldReceive('create')
            ->once()
            ->with($accountWalletInputDto)
            ->andReturn($mockWalletEntity);

        $accountWalletInputDtoMethod = $accountWalletInputDto;
        $accountWalletInputDtoMethod->shouldReceive('setAccountId')
            ->once()
            ->with($accountId);

        $accountWalletService = new AccountWalletCreateService($mockAccountService, $mockWalletService);
        $executed = $accountWalletService->execute($accountWalletInputDto);

        $this->assertInstanceOf(AccountWalletCreateOutputDto::class, $executed);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
