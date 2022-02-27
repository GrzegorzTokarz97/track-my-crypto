<?php

declare(strict_types=1);

namespace App\Components;

use Symfony\Component\Security\Core\Security;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('navigation', '/components/layout/navigation.html.twig')]
class Navigation
{
    private const PUBLIC_NAVIGATION_ITEMS = [
        'home' => [
            'name' => 'Home',
            'route' => 'index',
        ],
        'about' => [
            'name' => 'About',
            'route' => 'index',
        ],
    ];

    private const UN_AUTHENTICATED_NAVIGATION_ITEMS = [
        'login' => [
            'name' => 'Login',
            'route' => 'login',
        ],
        'register' => [
            'name' => 'Register',
            'route' => 'register',
        ],
    ];

    private const AUTHENTICATED_NAVIGATION_ITEMS = [
        'portfolio' => [
            'name' => 'Portfolio',
            'route' => 'index',
        ],
        'profile' => [
            'name' => 'Profile',
            'route' => 'index',
        ],
        'settings' => [
            'name' => 'Settings',
            'route' => 'index',
        ],
    ];

    public function __construct(
        private readonly Security $security
    ) {}

    public function getNavigationItems(): array
    {
        if (null !== $this->security->getUser()) {
            return [
                ...self::PUBLIC_NAVIGATION_ITEMS,
                ...self::AUTHENTICATED_NAVIGATION_ITEMS,
            ];
        }

        return [
            ...self::PUBLIC_NAVIGATION_ITEMS,
            ...self::UN_AUTHENTICATED_NAVIGATION_ITEMS,
        ];
    }
}
