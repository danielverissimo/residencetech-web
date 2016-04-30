<?php

return [

	'general' => [

		'legend'        => 'Detalhes',

		'name'          => 'Nome',
		'name_help'     => 'Digite um nome para sua página.',

		'slug'          => 'Slug',
		'slug_help'     => 'Uma palavra, sem espaços nem palavras especiais, traços são permitidos',

		'uri'           => 'Uri',
		'uri_help'      => 'Uri da sua página.',

		'https'         => 'Https',
		'https_help'    => 'Deve ser apresentado nessa página através de HTTPS?',

		'enabled'       => 'Estado',
		'enabled_help'  => 'Qual o estado desta página??',

		'type'          => 'Tipo de Armazenamento',
		'type_help'     => 'Como você deseja armazenar e editar esta página?',

		'database'      => 'Banco de Dados',
		'filesystem'    => 'Sistema de Arquivos',

		'template'      => 'Template',
		'template_help' => 'Template a ser usado na página',

		'section'       => 'Sessão',
		'section_help'  => 'Quais @section() você quer injetar o valor?',

		'value'         => 'Markup',
		'value_help'    => "O markup @content na página é habilitado.",

		'file'          => 'Arquivo',
		'file_help'     => 'Escolha o arquivo para usar nesta página.',

	],

	'access' => [

		'legend'          => 'Controle de Acesso',

		'visibility'      => 'Visibilidade',
		'visibility_help' => 'Selecione quando poderá acessar.',

		'always'          => 'Mostrar Sempre',
		'logged_in'       => 'Conectado',
		'logged_out'      => 'Desconectado',
		'admin'           => 'Somente Admin',

		'roles'           => 'Funções',
		'roles_help'      => 'Restringir o acesso a funções de usuário.',

	],

	'navigation' => [

		'legend'      => 'Navegação',

		'menu'        => 'Menu',
		'menu_help'   => 'Adicionar esta página ao seu navegação.',

		'select_menu' => '-- Selecione um Menu --',
		'top_level'   => '-- Nível Superior --',

	],

];
