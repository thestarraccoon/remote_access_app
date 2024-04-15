<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Models\Connection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddConnectionController extends Controller
{
    public function add(AddRequest $request): object
    {
        $data = $request->validated();

        $connection = Connection::create($data);

        return $connection;
    }

    public function update(AddRequest $request, Connection $connection, $id): array
    {
        $data = $request->validated();

        $connection_row = $connection::findOrFail($id);
        $connection_row->update($data);

        return $data;
    }

    public function delete(Connection $connection, $id): int
    {
        $connection_row = $connection::findOrFail($id);
        $connection_row->delete();

        return $id;
    }
}
