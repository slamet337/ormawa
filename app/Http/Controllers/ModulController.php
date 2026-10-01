<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;

class ModulController extends Controller
{
    public function download($id)
    {
        $modul = Modul::findOrFail($id);
        $modul->increment('downloads_count');

        if ($modul->file_path && file_exists(storage_path('app/public/' . $modul->file_path))) {
            return response()->download(storage_path('app/public/' . $modul->file_path));
        }

        if ($modul->file_url && $modul->file_url !== '#') {
            return redirect($modul->file_url);
        }

        return redirect()->back()->with('success', 'Modul "' . $modul->title . '" berhasil diunduh!');
    }
}
