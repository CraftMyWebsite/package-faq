<?php

namespace CMW\Permissions\Faq;

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Permission\IPermissionInit;
use CMW\Manager\Permission\PermissionInitType;

class Permissions implements IPermissionInit
{
    public function permissions(): array
    {
        return [
            new PermissionInitType(
                code: 'faq.show',
                description: LangManager::translate('faq.permissions.faq.show'),
            ),
            new PermissionInitType(
                code: 'faq.edit',
                description: LangManager::translate('faq.permissions.faq.edit'),
            ),
            new PermissionInitType(
                code: 'faq.create',
                description: LangManager::translate('faq.permissions.faq.create'),
            ),
            new PermissionInitType(
                code: 'faq.delete',
                description: LangManager::translate('faq.permissions.faq.delete'),
            ),
        ];
    }

}