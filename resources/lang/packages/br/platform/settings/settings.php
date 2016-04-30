<?php

return [

	// Section title
	'title' => 'Configurações Gerais',

	// Group
	'admin' => [

		// Group title
		'title' => 'Admin',

		// Fields
		'field' => [
			'help' => 'Ajuda',
		],

	],

	// Group
	'application' => [

		// Group title
		'title' => 'Aplicação Básica',

		// Fields
		'field' => [
			'title'     => 'Título',
			'tagline'   => 'Tagline',
			'copyright' => 'Copyright',
		],

	],

	// Group
	'email' => [

		// Group title
		'title' => 'Configurações de Email',

		// Fields
		'field' => [
			'driver'        => 'Driver de Email',
			'host'          => 'Endereço do Host',
			'port'          => 'Porta do Host',
			'encryption'    => 'Protocolo Encryption',
			'from_address'  => 'Do Endereço',
			'from_name'     => 'Do Nome',
			'username'      => 'Username Servidor',
			'password'      => 'Senha Servidor',
			'sendmail_path' => 'Caminho do sistema Sendmail',
			'pretend'       => 'Principal "Pretend"',
		],

	],

];
