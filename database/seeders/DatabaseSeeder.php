<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call(PermissionsTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(ConnectRelationshipsSeeder::class);

		Model::reguard();

		// $this->user();
		// $this->call([EventSeeder::class,]);
		$this->call(UsersTableSeeder::class);
		$this->call(PagesSeeder::class);

	}

	// private function user()
	// {
	// 	User::factory(5)->create();
	// 	$data = [
	// 		[
	// 			'name' => 'supAdmin',
	// 			'email' => 'admin@app.com',
	// 			'password' => Hash::make('password'),
	// 			'is_admin' => true,
	// 			'email_verified_at' => now(),
	// 		]
	// 	];
	// 	foreach ($data as $item) {
	// 		User::updateOrCreate($item);
	// 	}
	// }
}
