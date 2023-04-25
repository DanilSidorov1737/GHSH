<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function destroy($id)
    {
        // find the file by ID
        $file = \App\Models\File::find($id);

        // delete the file
        $file->delete();

        // redirect back to the index page with a success message
        return redirect()->route('home')->with('success', 'File deleted successfully.');
    }
}
