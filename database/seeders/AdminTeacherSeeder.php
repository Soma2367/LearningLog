<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Teacher::exists()) {
            $this->command?->info('先生はすでに登録されてます。');
            return;
        }

        $user = User::create([
            'name' => '松本',
            'email' => 'matsumotosoma1@gmail.com',
            'password' => Hash::make('soma2367'),
            'email_verified_at' => now(),
        ]);

        Teacher::create([
            'user_id' => $user->id,
        ]);

        $this->command?->info('先生のアカウントを作成しました。');
    }
}
