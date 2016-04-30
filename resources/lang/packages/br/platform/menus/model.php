<?php

return [

	'general' => [

		'create' => [
			'legend'      => 'Criar novo Link',
			'description' => 'Adicionar uma nova navigação para o item.',
		],

		'update' => [
			'legend'      => 'Editar Item',
			'description' => 'Atualizar um item de navegação existente.',
		],

		'name'      => 'Nome do Menu',
		'name_help' => 'Digite o nome para o Menu.',

		'slug'          => 'Slug',
		'slug_help'     => 'Uma palavra, sem espaços nem palavras especiais, traços são permitidos.',

		'name_item'      => 'Nome do Link',
		'name_item_help' => 'Digite o nome do Link.',

		'slug_item'      => 'Slug',
		'slug_item_help' => 'Uma palavra, sem espaços nem palavras especiais, traços são permitidos.',

		'enabled'      => 'Estado',
		'enabled_help' => 'Qual o estado do menu?',

		'parent'      => 'Pai',
		'parent_help' => 'Escolheu o pai que este item pertence a ou deixe a opção padrão selecionada para que seja um "root" item de menu deste menu.',

		'type'      => 'Tipo',
		'type_help' => 'Selecione o tipo de url.',

		'type_static' => 'Estático',

		'uri'      => 'Uri',
		'uri_help' => 'Digite a uri.',

		'secure'      => 'HTTPS',
		'secure_help' => 'Esse url deve ser através de HTTPS?',

		'visibility'      => 'Visibildade',
		'visibility_help' => 'Quando este item de menu deve ser visto?',

		'visibilities' => [
			'always'     => 'Mostrar Sempre',
			'logged_in'  => 'Conectado',
			'logged_out' => 'Desconectado',
			'admin'      => 'Somente Admin',
		],

		'roles'      => 'Funções',
		'roles_help' => 'Quais funções o usuário terá acesso',

		'class'      => 'Class',
		'class_help' => 'Classe que será atribuído ao elemento <li> em torno de seu item de menu.',

		'target'      => 'Target',
		'target_help' => 'O atributo de destino especifica onde para abrir o item de menu.',

		'targets' => [
			'self'   => 'Mesma Janela',
			'blank'  => 'Nova Janela',
			'parent' => 'Parent Frame',
			'top'    => 'Top Frame (Main Document)',
		],

		'regex'      => 'Expressão Regular',
		'regex_help' => 'Padrão avançadas de Regex "selecionados".',

		'created_at' => 'Criado em',

		'items_count' => '# de Items',
		'items'       => '{0} Nenhum item|{1} 1 item|[2,Inf] :count items',

		'item_details' => 'Detalhes',
		'advanced_settings' => 'Configurações Avançadas',

	],

];
