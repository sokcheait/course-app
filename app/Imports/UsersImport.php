<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterModelSaved;

class UsersImport implements
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    public function model(array $row)
    {
        // Skip duplicate emails
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        return new User([
            'first_name' => $row['first_name'],
            'last_name'  => $row['last_name'],
            'name'       => $row['first_name'] . ' ' . $row['last_name'],
            'email'      => $row['email'],
            'is_active'  => $row['is_active'] ?? true,
            'password'   => Hash::make('password'),
        ]);
    }

    /**
     * Create team AFTER user is saved
     */
    public function registerEvents(): array
    {
        return [
            AfterModelSaved::class => function (AfterModelSaved $event) {
                $user = $event->model;

                Team::forceCreate([
                    'user_id'        => $user->id,
                    'name'           => $user->name . "'s Team",
                    'personal_team'  => true,
                ]);
            },
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}