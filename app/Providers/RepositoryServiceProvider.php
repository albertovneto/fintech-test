<?php

namespace App\Providers;

use App\Repositories\Contract\{
    TransactionRepositoryInterface,
    AccountRepositoryInterface,
    WalletRepositoryInterface
};
use App\Repositories\{
    TransactionRepository,
    AccountRepository,
    WalletRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TransactionRepositoryInterface::class,
            TransactionRepository::class
        );

        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepository::class
        );

        $this->app->bind(
            WalletRepositoryInterface::class,
            WalletRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
