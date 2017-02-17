<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadSingle($entryId)
    {
        view('download.single');
    }

    public function downloadMultiple($data)
    {
        view('download.multiple');
    }
}
