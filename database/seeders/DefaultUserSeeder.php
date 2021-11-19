<?php

namespace Database\Seeders;

use App\Models\User;
use Filament\Filament;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        $count = User::where("email", env("ADMIN_EMAIL"))->exists();
        if ($count == 0) {
            User::create([
                'name' => 'Admin',
                'email' =>  env("ADMIN_EMAIL"),
                'password' => bcrypt(env("ADMIn_PASSWORD")),
                'email_verified_at' => now(),
            ]);
        }
            
        $model = Filament::auth()->getProvider()->getModel();

        $count = $model::where("email", env("ADMIN_EMAIL"))->exists();
        if ($count == 0) {
            $model::create([
            'name' => 'Admin',
            'email' =>  env("ADMIN_EMAIL"),
            'password' => bcrypt(env("ADMIN_PASSWORD")),
        ]);
        }
    }
}
