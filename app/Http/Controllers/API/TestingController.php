<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Costums\Inbound;
use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    public function index(Request $request)
    {

        $query = Inbound::newInbound()->paginate(10);

        return response()->json([
            'data' => $query
        ]);
    }
}