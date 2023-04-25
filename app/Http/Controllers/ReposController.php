<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReposController extends Controller
{
    public function show($name)
    {

    $repo = \App\Models\Repos::where('name', $name)->first();

    $repoId = \App\Models\Repos::where('name', $name)->pluck('id')->first();


    $files = \App\Models\File::where('repo_id', $repoId)->get();


    

    return view('repos-show', compact('repo', 'files'));

    }

    public function new()
    {


        return view('repo-new');

    }

    public function upload(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'repo_name' => 'required|string|max:255',
            //'repo_description' => 'nullable|string|max:255',
            //'repo_subject' => 'nullable|string|max:255',
            //'gridRadios' => 'required|in:option1,option2',
            //'readme' => 'nullable|file|mimes:md',
            'files.*' => 'nullable|file|max:10240', // 10 MB maximum file size
        ]);
    
        // Create a new Repo instance
        $repo = new \App\Models\Repos();
        $repo->name = $validatedData['repo_name'];
        //$repo->description = $validatedData['repo_description'];
        //$repo->subject = $validatedData['repo_subject'];
        //$repo->public = $validatedData['gridRadios'] === 'option1' ? true : false;
        $repo->owner_name = auth()->user()->name;
        $repo->user_id = auth()->user()->id;
        $repo->save();
    
        // Handle the ReadMe file upload
        // if ($request->hasFile('readme')) {
        //     $readme = $request->file('readme');
        //     $readmeName = 'ReadMe.md';
        //     $readmePath = $readme->storeAs('readmes', $readmeName);
        //     $repo->readme_path = $readmePath;
        //     $repo->save();
        // }

        $repo = \App\Models\Repos::where('name', $validatedData['repo_name'])->first();
        $id = $repo->id;
    
        // Handle the other files upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->getClientOriginalName();
                $path = $file->store('uploads', 'public');
                $fileModel = new \App\Models\File();
                $fileModel->repo_id = $id;
                $fileModel->name = $filename;
                $fileModel->pathname = $path;
                $fileModel->save();
            }
        }
    
        return redirect('home')->with('success', 'Your repository has been created successfully.');
    }


    public function add(Request $request, $repo_name)
    {
        
        // Validate the input
        $validatedData = $request->validate([
            'files.*' => 'nullable|file|max:10240', // 10 MB maximum file size
        ]);
        
        // Get the repo
        $repo = \App\Models\Repos::where('name', $repo_name)->first();
        $id = $repo->id;
        
        // Handle the file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->getClientOriginalName();
                $path = $file->store('uploads', 'public');
                $fileData = [
                    'repo_id' => $id,
                    'name' => $filename,
                    'pathname' => $path
                ];
                \App\Models\File::create($fileData);
            }
        }
        
        return redirect('home')->with('success', 'Your files have been added successfully.');
    }
}
