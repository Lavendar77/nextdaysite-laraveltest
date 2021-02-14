<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UploadUsersRequest;
use App\Imports\UsersImport;
use App\Imports\UsersQueueImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    /**
     * Export users.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportUsers()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    /**
     * Import a file (excel) upload
     *
     * @param UploadUsersRequest $request
     * @return void
     */
    public function importUsers(UploadUsersRequest $request)
    {
        $fileSizeInKB = round($request->file('file')->getSize() / 1024, 4);

        if ($fileSizeInKB > config('filesystems.max_file_size')) {
            Excel::import(new UsersQueueImport(), $request->file('file'));

            $request->session()->flash('status', 'Process was queued successfully!');
        } else {
            Excel::import(new UsersImport(), $request->file('file'));

            $request->session()->flash('status', 'Process was successful!');
        }

        return redirect()->back();
    }
}
