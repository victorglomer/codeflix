<?php

use Illuminate\Database\Migrations\Migration;
use \CodeFlix\Models\User;

class CreateUserAdminData extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $model = User::create([
                    'name' => env('ADMIN_DEFAULT_NAME'),
                    'email' => env('ADMIN_DEFAULT_EMAIL'),
                    'password' => bcrypt(env('ADMIN_DEFAULT_SECRET')),
                    'role' => \CodeFlix\Models\User::ROLE_ADMIN,
        ]);
        $model->verified = 1;
        $model->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $user = \CodeFlix\Models\User::where('email', '=', env('ADMIN_DEFAULT_EMAIL'))->first();
        if ($user instanceof \CodeFlix\Models\User) {
            $user->delete();
        }
    }

}
