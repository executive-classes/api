<?php

use App\Enums\Billing\TaxTypeEnum;
use App\Enums\System\SystemAppEnum;
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

return [

    /**
     * Billing
     */

    'biller_status' => [
        BillerStatusEnum::ACTIVE => [
            'name' => 'Active',
            'description' => 'Indicates that a biller is active and realize its payments'
        ],
        BillerStatusEnum::SUSPENDED => [
            'name' => 'Suspended',
            'description' => 'Indicates that a biller is suspended and will not generate collections'
        ],
        BillerStatusEnum::CANCELED => [
            'name' => 'Canceled',
            'description' => 'Indicates that a biller is canceled and will be no more generate collections'
        ],
        BillerStatusEnum::INACTIVE => [
            'name' => 'Inactive',
            'description' => 'Indicates that a biller is inactive'
        ],
    ],

    'collection_status' => [
        CollectionStatusEnum::PAYED => [
            'name' => 'Payed',
            'description' => 'Indicates that a collection was payed'
        ],
        CollectionStatusEnum::CHARGED => [
            'name' => 'Charger',
            'description' => 'Indicates that a collection was charged'
        ],
        CollectionStatusEnum::SCHEDULED => [
            'name' => 'Scheduled',
            'description' => 'Indicates that a collection is scheduled for payment'
        ],
        CollectionStatusEnum::POSTPONED => [
            'name' => 'Postponed',
            'description' => 'Indicates that a collection was postponed'
        ],
        CollectionStatusEnum::CANCELED => [
            'name' => 'Canceled',
            'description' => 'Indicates that a collection was canceled'
        ],
        CollectionStatusEnum::ERROR => [
            'name' => 'Error',
            'description' => 'Indicates that a collection has a error on its processing'
        ],
    ],

    'customer_status' => [
        CustomerStatusEnum::ACTIVE => [
            'name' => 'Active',
            'description' => 'Indicates that a customer is active and had to pay for its services'
        ],
        CustomerStatusEnum::SUSPENDED => [
            'name' => 'Suspended',
            'description' => 'Indicates that the customer is suspended and will not access your services until payment is made'
        ],
        CustomerStatusEnum::CANCELED => [
            'name' => 'Canceled',
            'description' => 'Indicates that a customer is canceled and will be no more a client'
        ],
        CustomerStatusEnum::INACTIVE => [
            'name' => 'Inactive',
            'description' => 'Indicates that a customer is inactive and is no more a client'
        ],
    ],

    'employee_position' => [
        EmployeePositionEnum::ADMINISTRATOR => [
            'name' => 'Administrator'
        ],
        EmployeePositionEnum::DEVELOPER => [
            'name' => 'Developer'
        ],
        EmployeePositionEnum::FINANCIAL => [
            'name' => 'Financial'
        ],
        EmployeePositionEnum::TECHNICIAN => [
            'name' => 'Technician'
        ],
        EmployeePositionEnum::HR => [
            'name' => 'Human Resources'
        ],
    ],

    'employee_status' => [
        EmployeeStatusEnum::ACTIVE => [
            'name' => 'Active',
            'description' => 'Indicates that a employee is active and can use the system'
        ],
        EmployeeStatusEnum::SUSPENDED => [
            'name' => 'Suspended',
            'description' => 'Indicates that a employee is suspended and can not use the system'
        ],
        EmployeeStatusEnum::CANCELED => [
            'name' => 'Canceled',
            'description' => 'Indicates that a employee is canceled and will no more use the system'
        ],
    ],

    'invoice_status' => [
        InvoiceStatusEnum::CREATED => [
            'name' => 'Created',
            'description' => 'Indicates that a invoice was created'
        ],
        InvoiceStatusEnum::GENERATED => [
            'name' => 'Generated',
            'description' => 'Indicates that a invoice and its XML was created'
        ],
        InvoiceStatusEnum::SENT => [
            'name' => 'Sent',
            'description' => 'Indicates that a invoice was sent to processing'
        ],
        InvoiceStatusEnum::PROCESSING => [
            'name' => 'Processing',
            'description' => 'Indicates that a invoice its during processing'
        ],
        InvoiceStatusEnum::OK => [
            'name' => 'OK',
            'description' => 'Indicates that a invoice was sent and it is ok'
        ],
        InvoiceStatusEnum::ERROR => [
            'name' => 'Error',
            'description' => 'Indicates that a invoice was sent but ocorred a error'
        ],
    ],

    'payment_interval' => [
        PaymentIntervalEnum::MENSAL => [
            'name' => 'Monthly',
            'description' => 'Payments made every 1 month'
        ],
        PaymentIntervalEnum::BIMESTRAL => [
            'name' => 'Bimonthly',
            'description' => 'Payments made every 2 months'
        ],
        PaymentIntervalEnum::TRIMESTRAL => [
            'name' => 'Quarterly',
            'description' => 'Payments made every 3 months'
        ],
        PaymentIntervalEnum::SEMESTRAL => [
            'name' => 'Semiannual',
            'description' => 'Payments made every 6 months'
        ],
        PaymentIntervalEnum::ANUAL => [
            'name' => 'Annual',
            'description' => 'Payments made every 12 months'
        ],
        PaymentIntervalEnum::BIANUAL => [
            'name' => 'Biannual',
            'description' => 'Payments made every 24 months'
        ],
    ],

    'payment_method' => [
        PaymentMethodEnum::CREDIT_CARD => [
            'name' => 'Credit Card',
            'description' => 'Payments made with Credit Card'
        ],
        PaymentMethodEnum::BANK_SLIP => [
            'name' => 'Bank Slip',
            'description' => 'Payments made with bank split'
        ],
        PaymentMethodEnum::PIX => [
            'name' => 'PIX',
            'description' => 'Payments made with a bank deposit'
        ],
        PaymentMethodEnum::DEPOSIT => [
            'name' => 'Deposit',
            'description' => 'Payments made with brazilian pix'
        ],
        PaymentMethodEnum::TRANSFER => [
            'name' => 'Transfer',
            'description' => 'Payments made with bank transfer'
        ],
    ],

    'service_status' => [
        StudentStatusEnum::ACTIVE => [
            'name' => 'Active',
            'description' => 'Indicates that a student is active and can attend classes'
        ],
        StudentStatusEnum::SUSPENDED => [
            'name' => 'Suspended',
            'description' => 'Indicates that a student is suspended and can not attend classes'
        ],
        StudentStatusEnum::CANCELED => [
            'name' => 'Canceled',
            'description' => 'Indicates that a student is canceled and will no more attend classes'
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
            'name' => 'Active',
            'description' => 'Indicates that a teacher is active and can teach classes'
        ],
        TeacherStatusEnum::SUSPENDED => [
            'name' => 'Suspended',
            'description' => 'Indicates that a teacher is suspended and can not teach classes'
        ],
        TeacherStatusEnum::CANCELED => [
            'name' => 'Canceled',
            'description' => 'Indicates that a teacher is canceled and will no more teach classes'
        ],
    ],

    /**
     * Classroom
     */

    'course_status' => [
        CourseStatusEnum::NEW => [
            'name' => 'New'
        ],
        CourseStatusEnum::IN_PROGRESS => [
            'name' => 'In progress'
        ],
        CourseStatusEnum::FINISHED => [
            'name' => 'Finished'
        ],
        CourseStatusEnum::APPROVED => [
            'name' => 'Approved'
        ],
        CourseStatusEnum::DISAPPROVED => [
            'name' => 'Disapproved'
        ],
        CourseStatusEnum::ABANDONED => [
            'name' => 'Abandoned'
        ],
    ],

    'lesson_status' => [
        LessonStatusEnum::NEW => [
            'name' => 'New'
        ],
        LessonStatusEnum::IN_PROGRESS => [
            'name' => 'In Progress'
        ],
        LessonStatusEnum::FINISHED => [
            'name' => 'Finished'
        ],
        LessonStatusEnum::ABANDONED => [
            'name' => 'Abandoned'
        ],
    ],

    'material_status' => [
        MaterialStatusEnum::NEW => [
            'name' => 'New'
        ],
        MaterialStatusEnum::VIEWED => [
            'name' => 'Viewed'
        ],
    ],

    'module_status' => [
        ModuleStatusEnum::NEW => [
            'name' => 'New'
        ],
        ModuleStatusEnum::IN_PROGRESS => [
            'name' => 'In Progress'
        ],
        ModuleStatusEnum::FINISHED => [
            'name' => 'Finished'
        ],
        ModuleStatusEnum::APPROVED => [
            'name' => 'Approved'
        ],
        ModuleStatusEnum::DISAPPROVED => [
            'name' => 'Disapproved'
        ],
        ModuleStatusEnum::ABANDONED => [
            'name' => 'Abandoned'
        ],
    ],

    'question_status' => [
        QuestionStatusEnum::READY => [
            'name' => 'Ready'
        ],
        QuestionStatusEnum::STARTED => [
            'name' => 'Started'
        ],
        QuestionStatusEnum::ANSWERED => [
            'name' => 'Answered'
        ],
        QuestionStatusEnum::GRADED => [
            'name' => 'Graded'
        ],
    ],

    'test_status' => [
        TestStatusEnum::NEW => [
            'name' => 'New'
        ],
        TestStatusEnum::READY => [
            'name' => 'Ready'
        ],
        TestStatusEnum::STARTED => [
            'name' => 'Started'
        ],
        TestStatusEnum::FINISHED => [
            'name' => 'Finished'
        ],
        TestStatusEnum::GRADED => [
            'name' => 'Graded'
        ],
        TestStatusEnum::CANCELED => [
            'name' => 'Canceled'
        ],
    ],

    /**
     * General
     */

    'category_type' => [
        CategoryTypeEnum::COURSE => [
            'name' => 'Course'
        ],
        CategoryTypeEnum::MODULE => [
            'name' => 'Module'
        ],
        CategoryTypeEnum::LESSON => [
            'name' => 'Lesson'
        ],
        CategoryTypeEnum::TEST => [
            'name' => 'Test'
        ],
        CategoryTypeEnum::QUESTION => [
            'name' => 'Question'
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
            'name' => 'Sent'
        ],
        MessageStatusEnum::SCHEDULED => [
            'name' => 'Scheduled'
        ],
        MessageStatusEnum::CANCELED => [
            'name' => 'Canceled'
        ],
        MessageStatusEnum::ERROR => [
            'name' => 'Error'
        ],
    ],

    'message_type' => [
        MessageTypeEnum::BILLING => [
            'name' => 'Billing'
        ],
        MessageTypeEnum::WARNING => [
            'name' => 'Warning'
        ],
    ],

    /**
     * System
     */

    'system_app' => [
        SystemAppEnum::SITE => [
            'description' => 'Executive Classes landing page'
        ],
        SystemAppEnum::PORTAL => [
            'description' => 'Executive Classes portal for customers, teachers and employees'
        ],
        SystemAppEnum::API => [
            'description' => 'Executive Classes API'
        ],
    ],

    'system_language' => [
        SystemLanguageEnum::EN => [
            'translate_name' => 'English'
        ],
        SystemLanguageEnum::PT_BR => [
            'translate_name' => 'Portuguese (Brazil)'
        ],
    ],
];
