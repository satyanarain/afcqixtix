<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$admin = new User();
		$admin->email = "admin@admin.com";
		$admin->password = bcrypt("admin");
		$admin->save();

		$editor = new User();
		$editor->email = "editor@editor.com";
		$editor->password = bcrypt("editor");
		$editor->save();

		$user = new User();
		$user->email = "user@user.com";
		$user->password = bcrypt("user");
		$user->save();
	}

}