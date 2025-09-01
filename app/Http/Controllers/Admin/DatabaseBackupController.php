<?php

namespace App\Http\Controllers\Admin;

use App\Database_Backup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DatabaseBackupController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkIfActivated');
        $this->middleware('admin');
    }

    public function index() {
        $savedb = Database_Backup::get();
        return view('/admin/database_backup/backup', compact('savedb'));
    }

    public function save() {
        Artisan::call('db:backup');
        return back()->with('success', 'Database backup created and logged successfully!');
    }

    // Download backup file
    public function download($id)
    {
        $backup = Database_Backup::findOrFail($id);

        if (file_exists($backup->path)) {
            return response()->download($backup->path, $backup->filename);
        }

        return back()->with('error', 'Backup file not found.');
    }

    // Delete backup file + record
    public function destroy($id)
    {
        $backup = Database_Backup::findOrFail($id);

        // Delete physical file if exists
        if (file_exists($backup->path)) {
            unlink($backup->path);
        }

        // Delete record from DB
        $backup->delete();

        return back()->with('success', 'Backup deleted successfully.');
    }
}
