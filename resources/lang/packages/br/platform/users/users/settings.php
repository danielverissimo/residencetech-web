<?php
return array(

	'section' => array(
		'general' => 'General',
	),

	'registration' => array(
		'label' => 'Permitir registro de usuário',
		'info'  => 'Ativar ou desativar o registro de usuário completamente.',
	),

	'activation' => array(
		'label' => 'Ativação da conta',
		'info'  => 'Alterar o comportamento da ativação.',

		// Activation types
		'automatic' => 'Nenhuma ativação (acesso imediato)',
		'email'     => 'Ativação via e-mail',
		'admin'     => 'Ativação de Admin',
	),

	'default_group' => array(
		'label' => 'Grupo padrão de usuários',
		'info'  => "Defina aqui o grupo padrão que os usuários que são atribuídos ao criar uma nova conta.",
	),
);
