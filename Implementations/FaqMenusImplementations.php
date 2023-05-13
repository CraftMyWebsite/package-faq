<?php

namespace CMW\Implementation\Faq;

use CMW\Interface\Core\IMenus;
use CMW\Manager\Lang\LangManager;

class FaqMenusImplementations implements IMenus {

    public function getRoutes(): array
    {
        return [
            LangManager::translate('faq.faq') => 'faq'
        ];
    }

    public function getPackageName(): string
    {
        return 'Faq';
    }
}