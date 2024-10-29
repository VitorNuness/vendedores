<?php

namespace Sellers\Sale\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Sellers\Sale\Actions\CreateSaleAction;
use Sellers\Sale\DTO\SaleDTO;
use Sellers\Sale\Http\Requests\CreateSaleRequest;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller
{
    public function __construct(
        private readonly CreateSaleAction $createSaleAction
    ) {
    }

    public function store(CreateSaleRequest $request): JsonResponse
    {
        $this->createSaleAction->handle(SaleDTO::fromRequest($request));

        return response()->json([], Response::HTTP_CREATED);
    }
}
