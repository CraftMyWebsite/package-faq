<?php

namespace CMW\Implementation\Faq;

use CMW\Interface\Core\IMenus;

class FaqMenusImplementations implements IMenus {

    public function getRoutes(): array
    {
        return [
            'faq'
        ];
    }

    public function getPackageName(): string
    {
        return 'Faq';
    }
}