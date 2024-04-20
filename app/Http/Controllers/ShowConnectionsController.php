<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Connection;

class ShowConnectionsController extends Controller
{
    public function index():object
    {
        $connections = Connection::paginate(10);

        return response()->json($connections);
    }

    public function getConnections(SearchRequest $request):object {
        $search_query = $request->validated();

        $query = Connection::query();

        $columns = ['clientName', 'note'];

        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $search_query['query'] . '%');
        }

        $connections = $query->paginate(10);

        return response()->json($connections);
    }
}
