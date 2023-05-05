<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create {email} {password} {role}';

    protected $description = 'Create a new user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $role = $this->argument('role');

        if (!in_array($role, ['admin', 'teacher', 'student'])) {
            $this->error('Invalid role. Allowed roles are: admin, teacher, student');
            return 1;
        }

        $user = new User;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->save();

        $this->info('User created successfully.');

        return 0;
    }
}
