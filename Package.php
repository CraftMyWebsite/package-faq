<?php

namespace CMW\Package\Faq;

use CMW\Manager\Package\IPackageConfig;
use CMW\Manager\Package\PackageMenuType;

class Package implements IPackageConfig
{
    public function name(): string
    {
        return "Faq";
    }

    public function version(): string
    {
        return "0.0.1";
    }

    public function authors(): array
    {
        return ["Teyir"];
    }

    public function isGame(): bool
    {
        return false;
    }

    public function isCore(): bool
    {
        return false;
    }

    public function menus(): ?array
    {
        return [
            new PackageMenuType(
                lang: "fr",
                icon: "fas fa-question-circle",
                title: "Faq",
                url: "faq/manage",
                permission: "faq.show",
                subMenus: []
            ),
            new PackageMenuType(
                lang: "en",
                icon: "fas fa-question-circle",
                title: "Calendar",
                url: "faq/manage",
                permission: "faq.show",
                subMenus: []
            ),
        ];
    }

    public function requiredPackages(): array
    {
        return ["Core"];
    }
}