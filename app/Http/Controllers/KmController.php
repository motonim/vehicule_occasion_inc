<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\KmService;
use Illuminate\Http\Request;

class KmController extends Controller
{
    public function index(KmService $kmService)
    {
        $kms = $kmService->getKms(
            request()->input('kms', []),
            request()->input('modeles', []),
            request()->input('marques', [])
        );

        return response()->json($kms);
    }
}
