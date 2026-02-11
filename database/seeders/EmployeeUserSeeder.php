<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Custom\Employee;

class EmployeeUserSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::whereNull('user_id')->get();

        foreach ($employees as $employee) {
            $parts = explode(' ', trim($employee->name));

            $firstName = $parts[0] ?? '';
            $lastName  = $parts[count($parts) - 1] ?? '';

            $email = strtolower(substr($firstName, 0, 1) . $lastName);

            // Create user
            $user = User::create([
                'name'              => $employee->name,
                'firstname'         => $firstName,
                'email'             => $email,
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token'    => Str::random(10),
                'section_id'        => $employee->section_id,
                'role_id'           => 5,
                'is_active'         => 1,
                'user_id'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            // Update employee with user_id
            $employee->update([
                'user_id' => $user->id,
            ]);
        }
    }
}
