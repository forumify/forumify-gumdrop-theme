<?php

declare(strict_types=1);

namespace Forumify\GumdropTheme;

use Forumify\ForumifyTheme;
use Forumify\Plugin\PluginMetadata;
use Forumify\Plugin\ThemeConfig;
use Forumify\Plugin\ThemeVar;
use Forumify\Plugin\ThemeVarType;

/**
 * A cozy clay toybox: puffy panels, a scalloped awning for a header, sprinkles on the
 * table and buttons you can squish. Dark mode is the same toybox at night.
 *
 * forumify's own variables keep their meaning, only their defaults change, so the admin
 * panel and every plugin pick up the palette. The gum-* variables drive the clay, the
 * awning and the sprinkles in public/style.css and can be tuned under
 * Admin → Settings → Themes.
 */
class GumdropTheme extends ForumifyTheme
{
    /**
     * New defaults for forumify's own variables, as [light, dark].
     */
    private const OVERRIDES = [
        'c-primary' => ['#6c4df6', '#b9a2ff'],
        'c-primary-accent' => ['#5a39ec', '#cdbcff'],
        'c-primary-text' => ['#ffffff', '#1e1630'],
        'c-secondary' => ['#ff8fb8', '#ff8fb8'],
        'c-secondary-text' => ['#3b2a5c', '#1e1630'],
        'c-call-to-action' => ['#ffb547', '#ffc46b'],
        'c-call-to-action-accent' => ['#ffa21f', '#ffd38f'],
        'c-call-to-action-text' => ['#3b2a5c', '#1e1630'],
        'c-text-primary' => ['#3b2a5c', '#f5efff'],
        'c-text-secondary' => ['#76689a', '#c0b3dc'],
        'c-success' => ['#d4f7e6', '#1f3d35'],
        'c-success-text' => ['#14674a', '#a6f0cf'],
        'c-info' => ['#e4dcff', '#2e2758'],
        'c-info-text' => ['#4a2fc0', '#d4c8ff'],
        'c-warning' => ['#ffecc7', '#47361a'],
        'c-warning-text' => ['#7a4b00', '#ffd99a'],
        'c-error' => ['#ffdbe7', '#4a1d32'],
        'c-error-text' => ['#a3164f', '#ffb8d1'],
        'c-elevation-0' => ['#e6f6ee', '#1e1630'],
        'c-elevation-1' => ['#ffffff', '#2a2043'],
        'c-elevation-2' => ['#f5f1ff', '#33284f'],
        'c-elevation-3' => ['#ece5ff', '#3c305c'],
        'c-elevation-4' => ['#e3daff', '#453869'],
        'c-elevation-5' => ['#d9ceff', '#4e4076'],
        'c-hover' => ['rgba(108, 77, 246, 0.07)', 'rgba(185, 162, 255, 0.09)'],
        'border-width' => ['2px', '2px'],
        'border-color' => ['rgba(59, 42, 92, 0.10)', 'rgba(245, 239, 255, 0.10)'],
        'border-radius' => ['28px', '28px'],
        'button-border-radius' => ['999px', '999px'],
        'font-size' => ['16px', '16px'],
    ];

    public function getPluginMetadata(): PluginMetadata
    {
        return new PluginMetadata(
            'Gumdrop',
            'forumify',
            'A cozy clay toybox: puffy pills, soft candy colours and squishy buttons.',
            'https://forumify.net',
        );
    }

    public function getThemeConfig(): ThemeConfig
    {
        $vars = array_map(static function (ThemeVar $var): ThemeVar {
            if (!isset(self::OVERRIDES[$var->key])) {
                return $var;
            }

            [$light, $dark] = self::OVERRIDES[$var->key];
            return new ThemeVar($var->key, $var->label, $var->type, $light, $dark, $var->help);
        }, parent::getThemeConfig()->vars);

        return new ThemeConfig(true, [
            ...$vars,
            new ThemeVar(
                'color-scheme',
                'Color Scheme',
                ThemeVarType::String,
                'light',
                'dark',
                'Tells the browser whether native controls and scrollbars should be light or dark.',
            ),
            new ThemeVar('gum-awning', 'Header Color', ThemeVarType::Color, '#6c4df6', '#382a5e', 'The scalloped awning across the top of the page.'),
            new ThemeVar('gum-awning-text', 'Header Text Color', ThemeVarType::Color, '#ffffff', '#f5efff'),
            new ThemeVar('gum-candy-1', 'Candy 1', ThemeVarType::Color, '#8b6dff', '#b9a2ff', 'Forum groups take turns wearing the four candy colours.'),
            new ThemeVar('gum-candy-2', 'Candy 2', ThemeVarType::Color, '#ff8fb8', '#ff8fb8'),
            new ThemeVar('gum-candy-3', 'Candy 3', ThemeVarType::Color, '#3ccf9a', '#6fe3b8'),
            new ThemeVar('gum-candy-4', 'Candy 4', ThemeVarType::Color, '#ffb547', '#ffc46b'),
            new ThemeVar('gum-clay-shadow', 'Clay Shadow', ThemeVarType::Color, 'rgba(59, 42, 92, 0.16)', 'rgba(0, 0, 0, 0.45)', 'The soft shadow under panels.'),
            new ThemeVar('gum-clay-shine', 'Clay Shine', ThemeVarType::Color, 'rgba(255, 255, 255, 0.95)', 'rgba(255, 255, 255, 0.07)', 'The highlight along the top of panels.'),
            new ThemeVar('gum-sprinkles', 'Sprinkles', ThemeVarType::String, '0.4', '0.18', 'Opacity of the sprinkles behind the page, between 0 and 1.'),
            new ThemeVar('gum-display-font', 'Display Font', ThemeVarType::String, "'Fredoka', sans-serif"),
            new ThemeVar('gum-font', 'Body Font', ThemeVarType::String, "'Nunito', sans-serif"),
        ]);
    }

    /**
     * Stylesheets loaded on every page while the theme is active, relative to public/.
     *
     * @return array<string>
     */
    public function getStylesheets(): array
    {
        return ['style.css'];
    }
}
