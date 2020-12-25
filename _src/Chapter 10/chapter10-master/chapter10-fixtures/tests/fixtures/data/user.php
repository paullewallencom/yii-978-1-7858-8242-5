<?php return [
	'user1' => [
		'id' 			=> 1,
		'email' 		=> 'jane.doe@example.com',
		'password' 		=> password_hash('password1', PASSWORD_BCRYPT, ['cost' => 13]),
		'first_name' 	=> 'Jane',
		'last_name' 	=> 'Doe',
		'role_id' 		=> 1,
		'created_at' 	=> time(),
		'updated_at' 	=> time()
	],
	'user2' => [
		'id' 			=> 2,
		'email' 		=> 'john.doe@example.com',
		'password' 		=> password_hash('password2', PASSWORD_BCRYPT, ['cost' => 13]),
		'first_name' 	=> 'John',
		'last_name' 	=> 'Doe',
		'role_id' 		=> 1,
		'created_at' 	=> time(),
		'updated_at' 	=> time()
	],
	'user3' => [
		'id' 			=> 3,
		'email' 		=> 'johnie.doe@example.com',
		'password' 		=> password_hash('password3', PASSWORD_BCRYPT, ['cost' => 13]),
		'first_name' 	=> 'Johnie',
		'last_name' 	=> 'Doe',
		'role_id' 		=> 1,
		'created_at' 	=> time(),
		'updated_at' 	=> time()
	],
	'admin' => [ 
		'id' 			=> 4,
		'email' 		=> 'admin@example.com',
		'password' 		=> password_hash('admin', PASSWORD_BCRYPT, ['cost' => 13]),
		'first_name' 	=> 'Site',
		'last_name' 	=> 'Administrator',
		'role_id' 		=> 2,
		'created_at' 	=> time(),
		'updated_at' 	=> time()
	]
];