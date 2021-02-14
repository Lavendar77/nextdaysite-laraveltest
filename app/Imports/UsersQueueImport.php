<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersQueueImport implements ToModel, WithValidation, WithHeadingRow, ShouldQueue, WithChunkReading
{
    use SkipsFailures, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'telephone' => $row['telephone'],
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * Validate the entry
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.first_name' => 'required|string',
            '*.last_name' => 'required|string',
            '*.email' => 'required|email|unique:users',
            '*.telephone' => 'required|string|unique:users'
        ];
    }

    /**
     * Chunk the entry into the DB.
     *
     * @return integer
     */
    public function chunkSize(): int
    {
        return 500;
    }
}
