<?php
/**
 * Part of the Platform application.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Platform
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

return array(

	// General messages
	'user_not_found'      => 'E-mail ou senha incorretos.',
	'user_already_exists' => 'Usuário já existe.',
	'user_is_activated'   => 'Sua conta já está ativada.',
	'user_not_activated'  => 'Sua conta não está ativada.',
	'user_is_banned'      => 'Sua conta está banida.',
	'invalid_email'       => 'E-mail inválido ou não foi encontrado..',
	'invalid_password'    => 'A senha está incorreta.',

	'throttling' => [
		'global' => 'Muitas tentativas foram feitas, acesso bloqueado por :delay segundo(s).',
		'ip' => 'Atividade suspeita em seu endereço de IP , acesso bloqueado por :delay segundo(s).',
		'user' => 'Muitas tentativas de login sem sucesso foram feitas em sua conta. Por favor, tente novamente em :delay segundo(s).',
	],

	// Success messages
	'success' => [
		'login'    => 'Acesso Permitido.',
		'register' => 'Conta criada com sucesso.',
		'update'   => 'Sua conta foi atualizada.',
		'activate' => 'Sua conta já foi ativada. Obrigado por se cadastrar.',

		'reset-password-confirm' => 'Sua redefinição de senha foi confirmado com sucesso. Agora você pode entrar com sua nova senha.',
	],

	// Error messages
	'error' => [
		'login'    => 'Houve um problema ao acessar sua conta. Por favor, tente novamente.',
		'register' => 'Houve um problema criando sua conta. Por favor, tente novamente.',
		'activate' => 'Sua conta já está ativada.',

		'reset-password'         => 'Incapaz de redefinir sua senha, por favor, verifique se você está usando um endereço de e-mail cadastrad.',
		'reset-password-confirm' => 'Não foi possível redefinir sua senha. Por favor, tente novamente.',
	],

);
