<?php

namespace App\Imports;

use App\Models\{User, Role};
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'role_id' => Role::firstOrCreate(
                ['slug' => Str::slug($row['role'])],
                ['name' => $row['role']]
            )->id,
            'name' => $row['name'],
            'nik' => $row['nik'],
            'email' => $row['email'],
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
