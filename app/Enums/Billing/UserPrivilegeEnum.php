<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class UserPrivilegeEnum extends Enum
{
    /**
     * General privileges.
     */
    const ALL = '*';

    /**
     * Auth privileges.
     */
    const CROSS_AUTH = 'auth:cross';

    /**
     * Address privileges.
     */
    const ADDRESS_GET = 'address:get';
    const ADDRESS_CREATE = 'address:create';
    const ADDRESS_UPDATE = 'address:update';
    const ADDRESS_DELETE = 'address:delete';

    /**
     * Biller privileges.
     */
    const BILLER_GET = 'biller:get';
    const BILLER_CREATE = 'biller:create';
    const BILLER_UPDATE = 'biller:update';
    const BILLER_CANCEL = 'biller:cancel';

    /**
     * Customer privileges.
     */
    const CUSTOMER_GET = 'customer:get';
    const CUSTOMER_CREATE = 'customer:create';
    const CUSTOMER_UPDATE = 'customer:update';
    const CUSTOMER_CANCEL = 'customer:cancel';

    /**
     * User privileges.
     */
    const USER_GET = 'user:get';
    const USER_CREATE = 'user:create';
    const USER_UPDATE = 'user:update';
    const USER_CANCEL = 'user:cancel';

    /**
     * Employees privileges.
     */
    const EMPLOYEE_GET = 'employee:get';
    const EMPLOYEE_CREATE = 'employee:create';
    const EMPLOYEE_UPDATE = 'employee:update';
    const EMPLOYEE_CANCEL = 'employee:cancel';

    /**
     * Teachers privileges.
     */
    const TEACHER_GET = 'teacher:get';
    const TEACHER_CREATE = 'teacher:create';
    const TEACHER_UPDATE = 'teacher:update';
    const TEACHER_CANCEL = 'teacher:cancel';

    /**
     * Students privileges.
     */
    const STUDENT_GET = 'student:get';
    const STUDENT_CREATE = 'student:create';
    const STUDENT_UPDATE = 'student:update';
    const STUDENT_CANCEL = 'student:cancel';

    /**
     * Message privileges.
     */
    const MESSAGE_GET    = 'message:get';
    const MESSAGE_CREATE = 'message:create';
    const MESSAGE_CANCEL = 'message:cancel';

    /**
     * Message template privileges
     */

    const MESSAGE_TEMPLATE_GET    = 'message_template:get';
    const MESSAGE_TEMPLATE_CREATE = 'message_template:create';
    const MESSAGE_TEMPLATE_UPDATE = 'message_template:update';
    const MESSAGE_TEMPLATE_DELETE = 'message_template:delete';

    /**
     * System Bug Log privileges
     */

    const BUG_LOG_GET    = 'buglog:get';

}