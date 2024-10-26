<?php

namespace Sellers\Authentication\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Sellers\Authentication\DTO\UserDTO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function __construct(
        public UserDTO $user,
    ) {
    }

    public function toArray(Request $request): array
    {
        return [
            "id"         => $this->user->id,
            "name"       => $this->user->name,
            "email"      => $this->user->email,
            "created_at" => Carbon::create($this->user->created_at)->toDateTimeString(),
            "updated_at" => Carbon::create($this->user->updated_at)->toDateTimeString(),
        ];
    }
}
