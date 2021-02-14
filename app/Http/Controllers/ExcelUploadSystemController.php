<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateRandomUsersRequest;
use App\Jobs\ExcelUploadSystem\CreateLargeUsers;
use App\Services\RandomUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ExcelUploadSystemController extends Controller
{
    /**
     * Show the excel upload system home page.
     *
     * @return void
     */
    public function index(Request $request)
    {
        return view('excel-upload-system.index');
    }

    /**
     * Generate the specified number of random users.
     * Download or Mail the excel export of those users.
     *
     * @param GenerateRandomUsersRequest $request
     * @return void
     */
    public function generateRandomUsers(GenerateRandomUsersRequest $request)
    {
        $numberOfUsers = $request->number_of_users;

        if ($numberOfUsers > 100) {
            // Create a job that handles the process
            Collection::times(($numberOfUsers / 100), function () {
                return CreateLargeUsers::dispatch(100);
            });

            $request->session()->flash('status', 'Process was queued successfully!');
        } else {
            // Handle the process
            RandomUsersService::make($numberOfUsers);

            $request->session()->flash('status', 'Process was successful!');
        }

        return redirect()->route('eus.index');
    }
}
