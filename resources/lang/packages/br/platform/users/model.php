<?php

return [

	'general' => [

		'legend'                     => 'Detalhes',

		'name'                       => 'Nome',

		'first_name'                 => 'Primeiro Nome',
		'first_name_help'            => 'Digite o primeiro nome',

		'last_name'                  => 'Sobrenome',
		'last_name_help'             => 'Digite o sobrenome.',

		'email'                      => 'E-mail',
		'email_help'                 => 'Digite o email',
	],

	'authorization' => [

		'legend'                     => 'Autorização',

		'roles'                      => 'Função',
		'roles_help'                 => 'Selecione as funções para atribuir ao usuário, lembre-se que um usuário assume as permissões dos papéis que são atribuídos.',

		'activated'                  => 'Ativado',
		'activated_help'             => 'Selecione se você deseja que o usuário seja activado automaticamente.',
	],

	'authentication' => [

		'legend'                     => 'Autenticação',

		'password_confirmation'      => 'Confirmação de Senha',
		'password_confirmation_help' => 'Confirme a senha',

		'create' => [
			'password'      => 'Senha',
			'password_help' => 'Digite a senha.',
		],

		'update' => [
			'password'      => 'Altere Senha',
			'password_help' => 'Digite a nova senha do usuários ou deixe em branco para permanecer inalterada.',
		],

	],

	'permissions' => [

		'legend'    => 'Permissões',

	],

];
