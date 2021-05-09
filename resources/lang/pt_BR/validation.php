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

    'accepted' => 'O campo :attribute precisa ser aceito.',  
    'active_url' => 'O campo :attribute não é uma URL válido.', 
    'after' => 'O campo :attribute deve ser uma data depois de :date.', 
    'after_or_equal' => 'O campo :attribute deve ser uma data posterior ou igual a :date.', 
    'alpha' => 'O campo :attribute deve conter apenas letras.', 
    'alpha_dash' => 'O campo :attribute só deve conter letras, números, travessões e sublinhados.', 
    'alpha_num' => 'O campo :attribute deve conter apenas letras e números.', 
    'array' => 'O campo :attribute deve ser uma lista.', 
    'before' => 'O campo :attribute deve ser uma data antes de :date.', 
    'before_or_equal' => 'O campo :attribute deve ser uma data anterior ou igual a :date.', 
    'between' => [ 
        'numeric' => 'O campo :attribute deve estar entre :min e :max.', 
        'file' => 'O campo :attribute deve estar entre :min e :max kilobytes.', 
        'string' => 'O campo :attribute deve estar entre :min e :max caracteres.', 
        'array' => 'O campo :attribute deve estar entre :min e :max items.', 
    ], 
    'boolean' => 'O campo :attribute field deve ser verdadeiro ou falso.', 
    'confirmed' => 'A confirmação do campo :attribute não corresponde.', 
    'date' => 'O campo :attribute não é uma data válida.', 
    'date_equals' => 'O campo :attribute deve ser uma data igual a :date.', 
    'date_format' => 'O campo :attribute não corresponde ao formato :format.', 
    'different' => 'Os campos :attribute e :other devem ser diferentes.', 
    'digits' => 'O campo :attribute deve ter :digits dígitos.', 
    'digits_between' => 'O campo :attribute deve estar entre :min e :max dígitos.', 
    'dimensions' => 'O campo :attribute tem dimensões de imagens inválidas.', 
    'distinct' => 'O campo :attribute tem o valor duplicado.', 
    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.', 
    'ends_with' => 'O campo :attribute deve terminar com um dos seguintes: :values.', 
    'exists' => 'O campo :attribute não foi encontrado no banco de dados.', 
    'file' => 'O campo :attribute deve ser um arquivo.', 
    'filled' => 'O campo :attribute deve ter um valor.', 
    'gt' => [ 
        'numeric' => 'O campo :attribute deve ser maior que :value.', 
        'file' => 'O campo :attribute deve ser maior que :value kilobytes.', 
        'string' => 'O campo :attribute deve ser maior que :value caracteres.', 
        'array' => 'O campo :attribute deve ter mais que :value itens.', 
    ], 
    'gte' => [ 
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.', 
        'file' => 'O campo :attribute deve ser maior ou igual a :value kilobytes.', 
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres.', 
        'array' => 'O campo :attribute deve ter :value itens ou mais', 
    ], 
    'image' => 'O campo :attribute deve ser uma imagem.', 
    'in' => 'O valor selecionado de :attribute é inválido.', 
    'in_array' => 'O campo :attribute não existe em :other.', 
    'integer' => 'O campo :attribute deve ser um inteiro.', 
    'ip' => 'O campo :attribute deve ser um endereço de IP válido.', 
    'ipv4' => 'O campo :attribute deve ser um endereço IPv4 válido.', 
    'ipv6' => 'O campo :attribute deve ser um endereço IPv6 válido.', 
    'json' => 'O campo :attribute deve ser uma string JSON válida.', 
    'lt' => [ 
        'numeric' => 'O campo :attribute deve ser menor que :value.', 
        'file' => 'O campo :attribute deve ser menor que :value kilobytes.', 
        'string' => 'O campo :attribute deve ser menor que :value caracteres.', 
        'array' => 'O campo :attribute deve ser menor que :value itens.', 
    ], 
    'lte' => [ 
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.', 
        'file' => 'O campo :attribute deve ser menor ou igual a :value kilobytes.', 
        'string' => 'O campo :attribute deve ser menor ou igual a :value characters.', 
        'array' => 'O campo :attribute deve ser menor ou igual a :value items.', 
    ], 
    'max' => [ 
        'numeric' => 'O campo :attribute não deve ser maior que :max.', 
        'file' => 'O campo :attribute não deve ser maior que :max kilobytes.', 
        'string' => 'O campo :attribute não deve ser maior que :max caracteres.', 
        'array' => 'O campo :attribute não deve ser maior que :max itens.', 
    ], 
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.', 
    'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.', 
    'min' => [ 
        'numeric' => 'O campo :attribute deve ser pelo menos :min.', 
        'file' => 'O campo :attribute deve ser pelo menos :min kilobytes.', 
        'string' => 'O campo :attribute deve ser pelo menos :min caracteres.', 
        'array' => 'O campo :attribute deve ser pelo menos :min itens.', 
    ], 
    'multiple_of' => 'O campo :attribute deve ser um múltiplo de :value.', 
    'not_in' => 'O valor selecionado de :attribute é inválido. ', 
    'not_regex' => 'O formato do campo :attribute é inválido.', 
    'numeric' => 'O campo :attribute deve ser um número.', 
    'password' => 'A senha está incorreta.', 
    'phone' => 'O telefone é invalido',
    'present' => 'O campo :attribute deve estar presente.', 
    'regex' => 'O formato do campo :attribute é inválido.', 
    'required' => 'O campo :attribute é obrigatório.', 
    'required_if' => 'O campo :attribute é necessário quando :other é :value.', 
    'required_unless' => 'O campo :attribute é necessário a menos que :other esteja em :values.', 
    'required_with' => 'O campo :attribute é necessário quando :values está presente.', 
    'required_with_all' => 'O campo :attribute é necessário quando :values estão presentes.', 
    'required_without' => 'O campo :attribute é necessário quando :values não está presente.', 
    'required_without_all' => 'O campo :attribute é necessário quando nenhum dos :values estão presentes.', 
    'same' => 'O campo :attribute e :other deve corresponder.', 
    'size' => [ 
        'numeric' => 'O campo :attribute deve ser :size.', 
        'file' => 'O campo :attribute deve ser :size kilobytes.', 
        'string' => 'O campo :attribute deve ser :size caracteres.', 
        'array' => 'O campo :attribute deve conter :size items.', 
    ], 
    'starts_with' => 'O campo :attribute deve começar com um dos seguintes: :values.', 
    'string' => 'O campo :attribute deve ser uma string.', 
    'tax_type' => 'Tipo de documento inválido fornecido.',
    'tax' => 'O documento :tax é invalido.',
    'timezone' => 'O campo :attribute deve ser uma zona válida.', 
    'unique' => 'O campo :attribute já foi tomada.', 
    'uploaded' => 'O campo :attribute não conseguiu carregar.', 
    'url' => 'O campo :attribute não é uma URL válido.',  
    'uuid' => 'O campo :attribute deve ser um UUID válido.',
    'valid_password' => 'A senha é inválida.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
