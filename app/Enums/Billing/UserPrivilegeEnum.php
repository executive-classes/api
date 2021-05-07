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