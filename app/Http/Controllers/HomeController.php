<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $repos1 = \App\Models\Repos::all();
$numOfFiles = [];
foreach ($repos1 as $repo) {
    $numOfFiles[$repo->id] = \App\Models\File::where('repo_id', $repo->id)->count();
}
$repos = [];
foreach ($repos1 as $repo) {
    $repos[] = [
        'id' => $repo->id,
        'name' => $repo->name,
        'owner_name' => $repo->owner_name,
        'num_files' => $numOfFiles[$repo->id]
    ];
}
$repos = collect($repos);
return view('home', compact('repos'));

    }   
}
