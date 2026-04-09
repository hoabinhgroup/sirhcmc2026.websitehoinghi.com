<?php

namespace App\Support;

class Navigation
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function headerMenu(): array
    {
        return config('navigation.header', []);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function footerMenu(): array
    {
        return config('navigation.footer', []);
    }

    /**
     * @return array<int, array{href: string, img: string}>
     */
    public static function footerPartners(): array
    {
        return config('navigation.footer_partners', []);
    }

    /**
     * @param  array<string, mixed>  $item
     */
    public static function isActive(array $item): bool
    {
        if (isset($item['active']) && is_array($item['active'])) {
            return request()->routeIs(...$item['active']);
        }

        return isset($item['route']) && request()->routeIs($item['route']);
    }
}
