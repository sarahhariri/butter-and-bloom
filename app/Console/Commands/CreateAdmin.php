<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create the bakery owner account';

    public function handle(): int
    {
       $admin = User::where('is_admin', true)->first();

if ($admin) {
    if (!$this->confirm('Reset the existing admin password?', false)) {
        return self::SUCCESS;
    }

    $password = $this->secret('New password (at least 12 characters)');
    $confirmation = $this->secret('Confirm new password');

    if (
        !is_string($password) ||
        mb_strlen($password) < 12 ||
        $password !== $confirmation
    ) {
        $this->error('Passwords must match and contain at least 12 characters.');

        return self::FAILURE;
    }

    $admin->password = Hash::make($password);
    $admin->save();

    $this->info('Admin password updated successfully.');

    return self::SUCCESS;
}

        $password = $this->secret('Choose an admin password (at least 12 characters)');

        if (!is_string($password) || mb_strlen($password) < 12) {
            $this->error('The password must contain at least 12 characters.');

            return self::FAILURE;
        }

        $confirmation = $this->secret('Confirm your password');

        if ($password !== $confirmation) {
            $this->error('The passwords do not match.');

            return self::FAILURE;
        }

        $admin = new User();
        $admin->name = 'Butter & Bloom';
        $admin->email = 'owner@butterbloom.test';
        $admin->password = Hash::make($password);
        $admin->is_admin = true;
        $admin->save();

        $this->info('Admin account created successfully.');

        return self::SUCCESS;
    }
}