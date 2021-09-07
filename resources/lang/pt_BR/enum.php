<?php

use App\Enums\Billing\TaxTypeEnum;
use App\Enums\Mailing\MessageTypeEnum;
use App\Enums\Billing\BillerStatusEnum;
use App\Enums\Classroom\TestStatusEnum;
use App\Enums\General\CategoryTypeEnum;
use App\Enums\Billing\InvoiceStatusEnum;
use App\Enums\Billing\PaymentMethodEnum;
use App\Enums\Billing\StudentStatusEnum;
use App\Enums\Billing\TeacherStatusEnum;
use App\Enums\Mailing\MessageStatusEnum;
use App\Enums\System\SystemLanguageEnum;
use App\Enums\Billing\CustomerStatusEnum;
use App\Enums\Billing\EmployeeStatusEnum;
use App\Enums\Classroom\CourseStatusEnum;
use App\Enums\Classroom\LessonStatusEnum;
use App\Enums\Classroom\ModuleStatusEnum;
use App\Enums\Billing\PaymentIntervalEnum;
use App\Enums\Billing\CollectionStatusEnum;
use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Classroom\MaterialStatusEnum;
use App\Enums\Classroom\QuestionStatusEnum;
use App\Enums\System\SystemAppEnum;

return [

    /**
     * Billing
     */

    'biller_status' => [
        BillerStatusEnum::ACTIVE => [
            'name' => 'Ativo',
            'description' => 'Indica que o biller está ativo e gera pagamentos'
        ],
        BillerStatusEnum::SUSPENDED => [
            'name' => 'Suspenso',
            'description' => 'Indica que o biller está suspenso e não irá gerar cobranças'
        ],
        BillerStatusEnum::CANCELED => [
            'name' => 'Cancelado',
            'description' => 'Indica que o biler está cancelado e não irá mais gerar cobranças'
        ],
        BillerStatusEnum::INACTIVE => [
            'name' => 'Inativo',
            'description' => 'Indica que o biller está inativo'
        ],
    ],

    'collection_status' => [
        CollectionStatusEnum::PAYED => [
            'name' => 'Paga',
            'description' => 'Indica que a cobrança foi paga'
        ],
        CollectionStatusEnum::CHARGED => [
            'name' => 'Cobrada',
            'description' => 'Indica que a cobrança foi cobrada'
        ],
        CollectionStatusEnum::SCHEDULED => [
            'name' => 'Agendado',
            'description' => 'Indica que a cobrança está agendada para cobrar'
        ],
        CollectionStatusEnum::POSTPONED => [
            'name' => 'Postergado',
            'description' => 'Indica que a cobrança foi postergada'
        ],
        CollectionStatusEnum::CANCELED => [
            'name' => 'Cancelado',
            'description' => 'Indifca que a cobrança foi cancelada'
        ],
        CollectionStatusEnum::ERROR => [
            'name' => 'Erro',
            'description' => 'Indica que a cobrança tem um erro durante o processamento'
        ],
    ],

    'customer_status' => [
        CustomerStatusEnum::ACTIVE => [
            'name' => 'Ativo',
            'description' => 'Indica que o cliente está ativo e tem que pagar pelo seus serviços'
        ],
        CustomerStatusEnum::SUSPENDED => [
            'name' => 'Suspenso',
            'description' => 'Indica que o cliente está suspenso e não irá acessar os seus serviços até a realização do pagamento'
        ],
        CustomerStatusEnum::CANCELED => [
            'name' => 'Cancelado',
            'description' => 'Indica que o cliente está cancelado e não será mais um cliente'
        ],
        CustomerStatusEnum::INACTIVE => [
            'name' => 'Inativo',
            'description' => 'Indica que o cliente está inativo e não tem mais serviços'
        ],
    ],

    'employee_position' => [
        EmployeePositionEnum::ADMINISTRATOR => [
            'name' => 'Administrador'
        ],
        EmployeePositionEnum::DEVELOPER => [
            'name' => 'Desenvolvedor'
        ],
        EmployeePositionEnum::FINANCIAL => [
            'name' => 'Financeiro'
        ],
        EmployeePositionEnum::TECHNICIAN => [
            'name' => 'Técnico'
        ],
        EmployeePositionEnum::HR => [
            'name' => 'Recursos Humanos'
        ],
    ],

    'employee_status' => [
        EmployeeStatusEnum::ACTIVE => [
            'name' => 'Ativo',
            'description' => 'Indica que o funcionario está ativo e pode usar o sistema'
        ],
        EmployeeStatusEnum::SUSPENDED => [
            'name' => 'Suspenso',
            'description' => 'Indica que o funcionário está suspenso e não pode usar o sistema'
        ],
        EmployeeStatusEnum::CANCELED => [
            'name' => 'Cancelado',
            'description' => 'Indica que o funcionário está cancelado e não irá mais usar o sistema'
        ],
    ],
    
    'invoice_status' => [
        InvoiceStatusEnum::CREATED => [
            'name' => 'Criada',
            'description' => 'Indicates que a nota fiscal foi criada'
        ],
        InvoiceStatusEnum::GENERATED => [
            'name' => 'Gerada',
            'description' => 'Indica que a nota fiscal e o XML dela foram criados'
        ],
        InvoiceStatusEnum::SENT => [
            'name' => 'Enviada',
            'description' => 'Indica que a nota fiscal foi enviada para processamento'
        ],
        InvoiceStatusEnum::PROCESSING => [
            'name' => 'Em processamento',
            'description' => 'Indica que a nota fiscal está em processamento'
        ],
        InvoiceStatusEnum::OK => [
            'name' => 'Emitida',
            'description' => 'Indica que a nota fiscal foi enviada e está OK'
        ],
        InvoiceStatusEnum::ERROR => [
            'name' => 'Erro',
            'description' => 'Indica que a nota ficsal foi enviada mas ocorreu um erro'
        ],
    ],

    'payment_interval' => [
        PaymentIntervalEnum::MENSAL => [
            'name' => 'Mensal',
            'description' => 'Pagamentos feitos a cada 1 mês'
        ],
        PaymentIntervalEnum::BIMESTRAL => [
            'name' => 'Bimestral',
            'description' => 'Pagamentos feitos a cada 2 meses'
        ],
        PaymentIntervalEnum::TRIMESTRAL => [
            'name' => 'Trimestral',
            'description' => 'Pagamentos feitos a cada 3 meses'
        ],
        PaymentIntervalEnum::SEMESTRAL => [
            'name' => 'Semestral',
            'description' => 'Pagamentos feitos a cada 6 meses'
        ],
        PaymentIntervalEnum::ANUAL => [
            'name' => 'Anual',
            'description' => 'Pagamentos feitos a cada 12 meses'
        ],
        PaymentIntervalEnum::BIANUAL => [
            'name' => 'Bianual',
            'description' => 'Pagamentos feitos a cada 24 meses'
        ],
    ],

    'payment_method' => [
        PaymentMethodEnum::CREDIT_CARD => [
            'name' => 'Cartão de Crédito',
            'description' => 'Pagamentos feitos com cartão de crédito'
        ],
        PaymentMethodEnum::BANK_SLIP => [
            'name' => 'Boleto Bancário',
            'description' => 'Pagamentos feitos com boleto'
        ],
        PaymentMethodEnum::PIX => [
            'name' => 'PIX',
            'description' => 'Pagamentos feitos com PIX'
        ],
        PaymentMethodEnum::DEPOSIT => [
            'name' => 'Depósito Bancário',
            'description' => 'Pagamentos feitos com depósito bancário'
        ],
        PaymentMethodEnum::TRANSFER => [
            'name' => 'Transferência Bancária',
            'description' => 'Pagamentos feitos com transferência bancária'
        ],
    ],

    'service_status' => [
        StudentStatusEnum::ACTIVE => [
            'name' => 'Ativo',
            'description' => 'Indica que o aluno está ativo e pode assistar às aulas'
        ],
        StudentStatusEnum::SUSPENDED => [
            'name' => 'Suspenso',
            'description' => 'Indica que o aluno está suspenso e não pode assistir às aulas'
        ],
        StudentStatusEnum::CANCELED => [
            'name' => 'Cancelado',
            'description' => 'Indica que o aluno está cancelado e não irá mais assistir aulas'
        ],
    ],

    'tax_type' => [
        TaxTypeEnum::CNPJ => [
            'name' => 'CNPJ'
        ],
        TaxTypeEnum::CPF => [
            'name' => 'CPF'
        ],
        TaxTypeEnum::RG => [
            'name' => 'RG'
        ],
        TaxTypeEnum::IE => [
            'name' => 'IE'
        ],
    ],

    'teacher_status' => [
        TeacherStatusEnum::ACTIVE => [
            'name' => 'Ativo',
            'description' => 'Indica que o professor está ativo e pode dar aulas'
        ],
        TeacherStatusEnum::SUSPENDED => [
            'name' => 'Suspenso',
            'description' => 'Indica que o professor está suspenso e não pode dar aulas'
        ],
        TeacherStatusEnum::CANCELED => [
            'name' => 'Cancelado',
            'description' => 'Indica que o professor está cancelado e não irá mais dar aulas'
        ],
    ],

    /**
     * Classroom
     */

    'course_status' => [
        CourseStatusEnum::NEW => [
            'name' => 'Novo'
        ],
        CourseStatusEnum::IN_PROGRESS => [
            'name' => 'Em andamento'
        ],
        CourseStatusEnum::FINISHED => [
            'name' => 'Finalizado'
        ],
        CourseStatusEnum::APPROVED => [
            'name' => 'Aprovado'
        ],
        CourseStatusEnum::DISAPPROVED => [
            'name' => 'Desaprovado'
        ],
        CourseStatusEnum::ABANDONED => [
            'name' => 'Abandonado'
        ],
    ],

    'lesson_status' => [
        LessonStatusEnum::NEW => [
            'name' => 'Novo'
        ],
        LessonStatusEnum::IN_PROGRESS => [
            'name' => 'Em andamento'
        ],
        LessonStatusEnum::FINISHED => [
            'name' => 'Finalizado'
        ],
        LessonStatusEnum::ABANDONED => [
            'name' => 'Abandonado'
        ],
    ],

    'material_status' => [
        MaterialStatusEnum::NEW => [
            'name' => 'Novo'
        ],
        MaterialStatusEnum::VIEWED => [
            'name' => 'Visto'
        ],
    ],

    'module_status' => [
        ModuleStatusEnum::NEW => [
            'name' => 'Novo'
        ],
        ModuleStatusEnum::IN_PROGRESS => [
            'name' => 'Em andamento'
        ],
        ModuleStatusEnum::FINISHED => [
            'name' => 'Finalizado'
        ],
        ModuleStatusEnum::APPROVED => [
            'name' => 'Aprovado'
        ],
        ModuleStatusEnum::DISAPPROVED => [
            'name' => 'Desaprovado'
        ],
        ModuleStatusEnum::ABANDONED => [
            'name' => 'Abandonado'
        ],
    ],

    'question_status' => [
        QuestionStatusEnum::READY => [
            'name' => 'Pronta'
        ],
        QuestionStatusEnum::STARTED => [
            'name' => 'Iniciada'
        ],
        QuestionStatusEnum::ANSWERED => [
            'name' => 'Respondida'
        ],
        QuestionStatusEnum::GRADED => [
            'name' => 'Pontuada'
        ],
    ],

    'test_status' => [
        TestStatusEnum::NEW => [
            'name' => 'Nova'
        ],
        TestStatusEnum::READY => [
            'name' => 'Pronta'
        ],
        TestStatusEnum::STARTED => [
            'name' => 'Iniciada'
        ],
        TestStatusEnum::FINISHED => [
            'name' => 'Finalizada'
        ],
        TestStatusEnum::GRADED => [
            'name' => 'Pontuada'
        ],
        TestStatusEnum::CANCELED => [
            'name' => 'Cancelada'
        ],
    ],

    /**
     * General
     */

    'category_type' => [
        CategoryTypeEnum::COURSE => [
            'name' => 'Curso'
        ],
        CategoryTypeEnum::MODULE => [
            'name' => 'Módulo'
        ],
        CategoryTypeEnum::LESSON => [
            'name' => 'Aula'
        ],
        CategoryTypeEnum::TEST => [
            'name' => 'Prova'
        ],
        CategoryTypeEnum::QUESTION => [
            'name' => 'Questão'
        ],
        CategoryTypeEnum::MATERIAL => [
            'name' => 'Material'
        ],
    ],

    /**
     * Mailing
     */

    'message_status' => [
        MessageStatusEnum::SENT => [
            'name' => 'Enviada'
        ],
        MessageStatusEnum::SCHEDULED => [
            'name' => 'Agendada'
        ],
        MessageStatusEnum::CANCELED => [
            'name' => 'Cancelada'
        ],
        MessageStatusEnum::ERROR => [
            'name' => 'Erro'
        ],
    ],

    'message_type' => [
        MessageTypeEnum::BILLING => [
            'name' => 'Cobrança'
        ],
        MessageTypeEnum::WARNING => [
            'name' => 'Aviso'
        ],
    ],

    /**
     * System
     */

    'system_app' => [
        SystemAppEnum::SITE => [
            'description' => 'Landing page da Executive Classes'
        ],
        SystemAppEnum::PORTAL => [
            'description' => 'Portal para clientes, professores e funcionários da Executive Classes'
        ],
        SystemAppEnum::API => [
            'description' => 'API da Executive Classes'
        ],
    ],

    'system_language' => [
        SystemLanguageEnum::EN => [
            'translate_name' => 'Inglês'
        ],
        SystemLanguageEnum::PT_BR => [
            'translate_name' => 'Português (Brasil)'
        ],
    ],
];
