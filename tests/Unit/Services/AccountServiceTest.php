<?php

namespace Tests\Unit\Services;

use App\Dto\AccountWalletCreateInputDto;
use App\Entities\AccountEntity;
use App\Entities\WalletEntity;
use App\Exceptions\NotFoundException;
use App\Repositories\AccountRepository;
use App\Repositories\Contract\AccountRepositoryInterface;
use App\Services\AccountService;
use PHPUnit\Framework\TestCase;
use Mockery;
use Throwable;

class AccountServiceTest extends TestCase
{

    public function testCreate()
    {
        $mockDto = Mockery::mock(AccountWalletCreateInputDto::class, [
            50.8,
        ]);

        $mockAccountEntity = Mockery::mock(AccountEntity::class, [
            1
        ]);

        $repositoryMock = Mockery::mock(AccountRepository::class, AccountRepositoryInterface::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with($mockDto)
            ->andReturn($mockAccountEntity);

        $accountService = new AccountService($repositoryMock);
        $created = $accountService->create($mockDto);

        $this->assertEquals(1, $created->id);
    }

    public function testGetById()
    {
        $accountId = 1;
        $balance = 550.8;

        $mockAccountEntity = Mockery::mock(AccountEntity::class, [
            $accountId,
            '38779876567',
            new WalletEntity(2, $balance)
        ]);

        $repositoryMock = Mockery::mock(AccountRepository::class, AccountRepositoryInterface::class);
        $repositoryMock->shouldReceive('getById')
            ->once()
            ->with($accountId)
            ->andReturn($mockAccountEntity);

        $accountService = new AccountService($repositoryMock);
        $account = $accountService->getByAccountId($accountId);

        $this->assertEquals($accountId, $account->id);
        $this->assertEquals($balance, $account->wallet->balance);
    }

    public function testGetByIdNotFound()
    {
        try {
            $accountId = 1;

            $repositoryMock = Mockery::mock(AccountRepository::class, AccountRepositoryInterface::class);
            $repositoryMock->shouldReceive('getById')
                ->once()
                ->with($accountId)
                ->andThrow(new NotFoundException());

            $accountService = new AccountService($repositoryMock);
            $accountService->getByAccountId($accountId);

            $this->assertTrue(false);
        } catch (Throwable $t) {
           $this->assertInstanceOf(NotFoundException::class, $t);
        }
    }
}
