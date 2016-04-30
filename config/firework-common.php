<?php

return [

	'envoy' => [
	    'connections' => [

			'local' => [
				'host'      => 'homestead.app',
				'username'  => 'vagrant',
				'password'  => '',
				'key'       => '/homedir/.ssh/id_rsa',
				'keyphrase' => '',
				'root'      => '/vagrant',
			],

			'development' => [
				'host'      => 'encantodev.mobileinn.com.br',
				'username'  => 'forge',
				'password'  => '',
				'key'       => '/home/vagrant/.ssh/id_rsa',
				'keyphrase' => '',
				'root'      => '/home/forge/encantodev.mobileinn.com.br',
			],

			'production' => [
				'host'      => 'encanto.mobileinn.com.br',
				'username'  => 'forge',
				'password'  => '',
				'key'       => '/home/vagrant/.ssh/id_rsa',
				'keyphrase' => '',
				'root'      => '/home/forge/encanto.mobileinn.com.br',
			],

		],
	],

	'install' => [
		'email'            => 'admin@mobileinn.com.br',
		'password'         => 'qwe123',
		'password_confirm' => 'qwe123',
	],

	'seeders' => [
		'LocationsSeeder',
		'MenuSeeder',
		'ApartmenttypesTableSeeder',
		'ApartmentcomplexTableSeeder',
		'BlocksTableSeeder',
		'DocumentTypesTableSeeder',
		'PeopleTableSeeder',
	],

];
