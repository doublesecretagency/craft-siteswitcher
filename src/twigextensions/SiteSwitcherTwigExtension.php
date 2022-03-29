<?php
/**
 * Site Switcher plugin for Craft CMS
 *
 * Easily switch between sites on any page of your website.
 *
 * @author    Double Secret Agency
 * @link      https://www.doublesecretagency.com/
 * @copyright Copyright (c) 2015 Double Secret Agency
 */

namespace doublesecretagency\siteswitcher\twigextensions;

use craft\base\Element;
use doublesecretagency\siteswitcher\SiteSwitcher;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class SiteSwitcherTwigExtension
 * @since 2.0.0
 */
class SiteSwitcherTwigExtension extends AbstractExtension
{

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'Site Switcher';
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('siteSwitcher', [$this, 'siteSwitcher'])
        ];
    }

    /**
     * Shortcut to service method.
     *
     * @param null|string $siteHandle
     * @param null|Element $element
     * @param bool $fallbackToHomepage
     * @return null|string
     */
    public function siteSwitcher(?string $siteHandle = null, ?Element $element = null, bool $fallbackToHomepage = false): ?string
    {
        return SiteSwitcher::$plugin->siteSwitcher->url($siteHandle, $element, $fallbackToHomepage);
    }

}
