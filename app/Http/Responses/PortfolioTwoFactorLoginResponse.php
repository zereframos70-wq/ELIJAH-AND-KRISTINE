<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;

class PortfolioTwoFactorLoginResponse implements TwoFactorLoginResponse
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : Inertia::location(route('home'));
    }
}
