<?php

namespace Database\Seeders;

use App\Models\User;
use RuntimeException;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!$this->hasCredentials()) {
            throw new RuntimeException('Cannot seed admin. Credentials were not provided');
        }

        $admin =  User::query()
            ->firstOrNew(
                ['email' => config('admin.email'),],
                [
                    'name' => config('admin.name'),
                    'password' => config('admin.password'),
                    'role' => UserRole::ADMIN,
                    'email_verified_at' => now()
                ]
            );
        $admin->save();
    }
    private function hasCredentials(): bool
    {
        return null !== config('admin.name') &&
            null !==  config('admin.email') &&
            null !== config('admin.password');
    }
}
