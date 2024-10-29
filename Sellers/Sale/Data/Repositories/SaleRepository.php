<?php

namespace Sellers\Sale\Data\Repositories;

use Sellers\Sale\DTO\SaleDTO;

class SaleRepository
{
    public function store(SaleDTO $saleDTO): SaleDTO
    {
        $sale = auth()->user()
            ->sales()
            ->create(
                [
                    'amount' => $saleDTO->amount,
                ]
            );

        return SaleDTO::fromModel($sale);
    }
}
