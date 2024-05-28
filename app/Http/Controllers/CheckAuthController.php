<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckAuthController extends Controller
{
    public function checkAccess(Request $request)
    {
        if ($request->user()) {
            if ($request->user()->canAccessRoute($request->path())) {
                return response()->json(['isAuth' => true]);
            } else {
                return response()->json(['isAuth' => false]);
            }
        } else {
            return response()->json(['isAuth' => false]);
        }
    }
}
