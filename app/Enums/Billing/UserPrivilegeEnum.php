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

}