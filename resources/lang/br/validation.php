<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "O :attribute deve ser aceito.",
	"active_url"           => "O :attribute não é uma URL válida.",
	"after"                => "O :attribute deve ser uma data superior a :date.",
	"alpha"                => "O :attribute deve conter apenas letras.",
	"alpha_dash"           => "O :attribute deve conter apenas letras, numeros, e traços.",
	"alpha_num"            => "O :attribute deve conter apenas letras e numeros.",
	"array"                => "O :attribute deve ser um vetor.",
	"before"               => "O :attribute deve ser uma data inferior a :date.",
	"between"              => [
		"numeric" => "O :attribute deve estar entre :min e :max.",
		"file"    => "O :attribute deve estar entre :min e :max kilobytes.",
		"string"  => "O :attribute deve estar entre :min e :max digitos.",
		"array"   => "O :attribute deve ter entre :min e :max itens.",
	],
	"boolean"              => "O :attribute precisa ser verdadeiro ou falso.",
	"confirmed"            => "O :attribute confirmação não corresponde.",
	"date"                 => "O :attribute não é uma data válida.",
	"date_format"          => "O :attribute não bate com o formato :format.",
	"different"            => "O :attribute e :other devem ser diferentes.",
	"digits"               => "O :attribute deve conter :digits posições.",
	"digits_between"       => "O :attribute deve ter entre :min e :max digitos.",
	"email"                => "O :attribute deve ser um endereço de e-mail válido.",
	"filled"               => "O :attribute é obrigatório.",
		"exists"               => "O campo selecionado é inválido.",
	"image"                => "O campo deve ser uma imagem.",
	"in"                   => "O campo selecionado é invalido.",
	"integer"              => "O campo deve ser um inteiro.",
	"ip"                   => "O campo deve ser um endereço de IP válido.",
	"max"                  => [
		"numeric" => "O campo não deve ser maior que :max.",
		"file"    => "O campo não deve ser maior que :max kilobytes.",
		"string"  => "O campo não deve ser maior que :max posições.",
		"array"   => "O campo não deve ter mais do que :max itens.",
	],
	"mimes"                => "O campo deve ser um arquivo do(s) tipo(s): :values.",
	"min"                  => [
		"numeric" => "O campo deve ser pelo menos :min.",
		"file"    => "O campo deve ter pelo menos :min kilobytes.",
		"string"  => "O campo deve ter pelo menos :min posições.",
		"array"   => "O campo deve ter pelo menos :min itens.",
	],
	"not_in"               => "O campo selecionado é inválido.",
	"numeric"              => "O campo deve ser numérico.",
	"regex"                => "O campo está com formato inválido.",
	"required"             => "O campo é obrigatório.",
	"required_if"          => "O campo é obrigatório se :other for :value.",
	"required_with"        => "O campo é obrigatório se :values estiver presente.",
	"required_with_all"    => "O campo é obrigatório se :values estiver presente.",
	"required_without"     => "O campo é obrigatório se :values não estiver presente.",
	"required_without_all" => "O campo é obrigatório se nenhum dos :values estiver presente(s).",
	"same"                 => "O campo e :other devem corresponder.",
	"size"                 => [
		"numeric" => "O campo deve ter :size posições.",
		"file"    => "O campo deve ter :size kilobytes.",
		"string"  => "O campo deve ter :size posições.",
		"array"   => "O campo deve conter :size itens.",
	],
	"unique"               => "O campo já está sendo usado.",
	"url"                  => "O campo está com formato inválido.",
	"timezone"             => "O :attribute precisa ser uma zona válida",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
