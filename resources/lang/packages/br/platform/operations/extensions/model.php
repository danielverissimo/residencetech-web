<?php

return [

	'general'=> [

		'vendor'    => 'Vendor',
		'name'      => 'Nome',
		'author'    => 'Autor',
		'slug'      => 'Slug',
		'version'   => 'Versão',
		'installed' => 'Instalado',
		'enabled'   => 'Habilitado',

	],

	'scaffold'=> [

		'legend'           => 'Scaffold Componentes',
		'help'             => 'Criar rapidamente um protótipo sua extensão',
		'instruction'      => 'Criar rapidamente conjuntos de componentes para a sua extensão.',

		'name'             => 'Nome do Scaffold',
		'name_help'        => 'Nome para ser usado em todos os componentes.',
		'name_placeholder' => 'Nome do Scaffold. (blog, organization, inventory)',

	],

	'controller'=> [

		'legend'               => 'Controller',
		'help'                 => 'Protótipo controller',
		'instruction'          => 'Criar rapidamente um controller para sua extensão.',

		'name'                 => 'Nome do Controller.',
		'name_help'            => 'Nome do Controller.',
		'name_placeholder'     => 'Nome do Controller. (posts)',

		'location'             => 'Localização',
		'location_help'        => 'Selecione a localização para o controller.',
		'location_placeholder' => 'Localização. (Frontend)',

	],

	'repository'=> [

		'legend'           => 'Repositório',
		'help'             => 'Protótipo repository',
		'instruction'      => 'Criar rapidamente um repository para sua extensão.',

		'name'             => 'Nome do Repositório',
		'name_help'        => 'Nome do Repositório.',
		'name_placeholder' => 'Nome do Repositório. (author, user, post)',

	],

	'widget'=> [

		'legend'           => 'Widget',
		'help'             => 'Protótipo widget.',
		'instruction'      => 'Criar rapidamente um widget para sua extensão.',

		'name'             => 'Nome do Widgets.',
		'name_help'        => 'Nome do Widgets.',
		'name_placeholder' => 'Nome do Widgets. (author, user, post)',

	],

	'migration'=> [

		'legend'                   => 'Migration',
		'help'                     => 'Criar um migration',
		'instruction'              => 'Adicionar colunas',

		'timestamps'               => 'Timestamps',
		'timestamps_help'          => 'Adds created_at, updated_at colunas de timestamp.',

		'auto_increment'           => 'Auto Incremento.',
		'auto_increment_help'      => 'Add auto incremento na coluna id.',

		'table_name'               => 'Nome da Tabela',
		'table_name_help'          => 'O que sua tabela de banco de dados deve ser chamada.',
		'table_name_placeholder'   => 'Nome da Tabela. (authors, users, user_posts)',

		'seeder'                   => 'Registros de Seed',
		'seeder_help'              => 'Quantos registros você quer criar?',
		'seeder_count_placeholder' => '# rows. (100, 1000, etc)',

	],

	'seeder'=> [

		'legend'                 => 'Seeder',
		'help'                   => 'Criar seed na Base de dados',
		'instruction'            => 'Criar rapidamente um seed para sua tabela.',

		'table_name'             => 'Nome da Tabela',
		'table_name_help'        => 'Criar um seeder.',
		'table_name_placeholder' => 'Nome da Tabela. (authors, users, posts)',

		'records'                => '# Registros',
		'records_help'           => 'Quantos registros você quer criar?',
		'records_placeholder'    => '# registros. (100, 1000, etc)',

	],

	'model'=> [

		'legend'           => 'Model',
		'help'             => 'Protótipo do model',
		'instruction'      => 'Rapidly scaffolds a model for your extension.',

		'name'             => 'Model name',
		'name_help'        => 'Scaffolds a model.',
		'name_placeholder' => 'Model name. (author, user, post)',

	],

	'datagrid'=> [

		'legend'            => 'DataGrid',
		'help'              => 'Protótipo do DataGrid',
		'instruction'       => 'Criar rapidamente um DataGrid para sua extensão',

		'name'              => 'Nome do Datagrid',
		'name_help'         => 'Nome do Datagrid.',
		'name_placeholder'  => 'Nome do Datagrid. (main, posts, users)',

		'theme'             => 'Selecione o Tema',
		'theme_help'        => 'Selecione o Tema das views que são criadas com o Datagrid.',
		'theme_placeholder' => 'Selecione o Tema',

		'view'              => 'Nome da View',
		'view_help'         => 'Criar a View para o DataGrid',
		'view_placeholder'  => 'Nome da View. (author, user, post)',

	],

];
