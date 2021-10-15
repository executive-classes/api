<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

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
     * User privileges.
     */
    const USER_GET = 'user:get';
    const USER_CREATE = 'user:create';
    const USER_UPDATE = 'user:update';
    const USER_CANCEL = 'user:cancel';

    /**
     * Course privileges.
     */
    const COURSE_GET = 'course:get';
    const COURSE_CREATE = 'course:create';
    const COURSE_UPDATE = 'course:update';
    const COURSE_CANCEL = 'course:cancel';

    /**
     * Material privileges.
     */
    const MATERIAL_GET = 'material:get';
    const MATERIAL_CREATE = 'material:create';
    const MATERIAL_UPDATE = 'material:update';
    const MATERIAL_CANCEL = 'material:cancel';

    /**
     * Module privileges.
     */
    const MODULE_GET = 'module:get';
    const MODULE_CREATE = 'module:create';
    const MODULE_UPDATE = 'module:update';
    const MODULE_CANCEL = 'module:cancel';

    /**
     * Lesson privileges.
     */
    const LESSON_GET = 'lesson:get';
    const LESSON_CREATE = 'lesson:create';
    const LESSON_UPDATE = 'lesson:update';
    const LESSON_CANCEL = 'lesson:cancel';

    /**
     * Question privileges.
     */
    const QUESTION_GET = 'question:get';
    const QUESTION_CREATE = 'question:create';
    const QUESTION_UPDATE = 'question:update';
    const QUESTION_CANCEL = 'question:cancel';

    /**
     * Test privileges.
     */
    const TEST_GET = 'test:get';
    const TEST_CREATE = 'test:create';
    const TEST_UPDATE = 'test:update';
    const TEST_CANCEL = 'test:cancel';

    /**
     * Category privileges.
     */
    const CATEGORY_GET = 'category:get';
    const CATEGORY_CREATE = 'category:create';
    const CATEGORY_UPDATE = 'category:update';
    const CATEGORY_DELETE = 'category:delete';

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
    const BUG_LOG_GET = 'buglog:get';

}