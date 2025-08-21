<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('What is your name?');
        $user['email'] = $this->ask('What is your email?');
        $user['password'] = $this->secret('What is your password?');
        $roleName = $this->choice('What is your role?', ['admin', 'editor']);
        $role = Role::where('name', $roleName)->first();
        if(!$role){
            $this->error('Role not found');
            return -1;
        }

        $validator = Validator::make($user, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
                return -1;
            }
        }

        DB::transaction(function () use ($user, $role) {
            $user['password'] = Hash::make($user['password']);
            $newUser = User::create($user);
            $newUser->roles()->attach($role->id);
        });

        $this->info('User created successfully');
        return 0;
    }
}
