<?php

namespace Sellers\Sale\Actions;

use Sellers\Sale\Data\Repositories\SaleRepository;
use Sellers\Sale\DTO\SaleDTO;

class CreateSaleAction
{
    public function __construct(
        private readonly SaleRepository $saleRepository
    ) {
    }

    public function handle(SaleDTO $saleDTO): void
    {
        $this->saleRepository->store($saleDTO);
    }
}
