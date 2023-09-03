<?php

namespace Tests\Unit\Services;

use App\Dto\AccountWalletCreateInputDto;
use App\Dto\WalletUpdateInputDto;
use App\Entities\WalletEntity;
use App\Repositories\Contract\WalletRepositoryInterface;
use App\Repositories\WalletRepository;
use App\Services\WalletService;
use PHPUnit\Framework\TestCase;
use Mockery;

class WalletServiceTest extends TestCase
{
    public function testCreate()
    {
        $accountId = 1;
        $balance = 50.0;

        $mockDto = Mockery::mock(AccountWalletCreateInputDto::class, [
            $balance,
            null,
            $accountId
        ]);

        $mockWalletEntity = Mockery::mock(WalletEntity::class, [
            $accountId,
            1,
            $balance
        ]);

        $repositoryMock = Mockery::mock(WalletRepository::class, WalletRepositoryInterface::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with($mockDto)
            ->andReturn($mockWalletEntity);

        $walletService = new WalletService($repositoryMock);
        $created = $walletService->create($mockDto);

        $this->assertEquals(1, $created->id);
        $this->assertInstanceOf(WalletEntity::class, $created);
    }

    public function testUpdate()
    {
        $accountId = 1;
        $id = 2;
        $balance = 50.0;

        $mockDto = Mockery::mock(WalletUpdateInputDto::class, [
            $id,
            $accountId,
            $balance
        ]);

        $mockWalletEntity = Mockery::mock(WalletEntity::class, [
            $accountId,
            $id,
            $balance
        ]);

        $repositoryMock = Mockery::mock(WalletRepository::class, WalletRepositoryInterface::class);
        $repositoryMock->shouldReceive('update')
            ->once()
            ->with($mockDto)
            ->andReturn($mockWalletEntity);

        $walletService = new WalletService($repositoryMock);
        $updated = $walletService->update($mockDto);

        $this->assertEquals(2, $updated->id);
        $this->assertInstanceOf(WalletEntity::class, $updated);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
