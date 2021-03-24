<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\DB;

class FileUploadController extends Controller
{
    //
    public function index()
    {
        return view('file-upload');
    }

    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);

        $fileName = time() . '.' . $request->file->extension();

        $request->file->move(public_path('file'), $fileName);

        /* Store $fileName name in DATABASE from HERE */
        // File::create(['name' => $fileName]);

        $values = array('id' => 1, 'name' => $fileName);
        DB::table('files')->insert($values);

        return back()
            ->with('success', 'You have successfully file uplaod.')
            ->with('file', $fileName);
    }

    public function getfile()
    {
        return response()->download(public_path('file/1615907943.pdf'));
    }
}
