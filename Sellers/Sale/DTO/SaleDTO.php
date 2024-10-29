<?php

namespace Sellers\Sale\DTO;

use Sellers\Sale\Data\Models\Sale;
use Sellers\Sale\Http\Requests\CreateSaleRequest;

class SaleDTO
{
    public function __construct(
        public ?int $id = null,
        public ?int $amount = null,
        public ?int $commission = null,
        public ?string $total = null,
        public ?int $owner_id = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {
    }

    public static function fromModel(Sale $model): self
    {
        return new self(
            $model->id,
            $model->amount,
            $model->commission,
            $model->total,
            $model->owner->id,
            $model->created_at->toDateTimeString(),
            $model->updated_at->toDateTimeString(),
        );
    }

    public static function fromRequest(CreateSaleRequest $request): self
    {
        return new self(
            amount: $request->amount,
        );
    }
}
