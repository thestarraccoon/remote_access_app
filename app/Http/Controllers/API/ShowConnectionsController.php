<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Connection;

class ShowConnectionsController extends Controller
{
    public function index()
    {
        $connections = Connection::paginate(15);

        return response()->json($connections);
//        return $connections;
    }
}
