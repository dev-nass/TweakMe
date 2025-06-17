<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index()
    {
        return view('search.index');
    }


    public function search(Request $request)
    {

        $users = User::query()
            ->where('username', 'LIKE', '%'.request('q').'%')
            ->get();

        return view('search.results', [
            'users' => $users,
        ]);
    }
}
