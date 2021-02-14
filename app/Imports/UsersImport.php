<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements
    ToModel,
    WithValidation,
    WithHeadingRow,
    WithChunkReading,
    WithBatchInserts,
    SkipsOnError,
    SkipsOnFailure
{
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|unique:users'
        ];
    }

    /**
     * Batch insert data into the DB.
     *
     * @return integer
     */
    public function batchSize(): int
    {
        return 100;
    }

    /**
     * Chunk the entry into the DB.
     *
     * @return integer
     */
    public function chunkSize(): int
    {
        return 100;
    }

    /**
     * Skip failures.
     *
     * @param Failure[] $failures
     * @return void
     */
    public function onFailure(Failure ...$failures)
    {
        Log::error('Users import failed.', $failures);
    }

    /**
     * Skip errors.
     *
     * @param \Throwable $e
     * @return void
     */
    public function onError(\Throwable $e)
    {
        Log::error('Error occurred during users import.', [
            'error' => $e
        ]);
    }
}
