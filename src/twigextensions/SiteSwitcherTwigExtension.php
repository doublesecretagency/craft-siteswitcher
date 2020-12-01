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

use Craft;
use doublesecretagency\siteswitcher\SiteSwitcher;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class SiteSwitcherTwigExtension
 * @since 2.0.0
 */
class SiteSwitcherTwigExtension extends Twig_Extension
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
            new Twig_SimpleFunction('siteSwitcher', [$this, 'siteSwitcher']),
            new Twig_SimpleFunction('ll', [$this, 'll']), // DEPRECATED
        ];
    }

    /**
     * Shortcut to service method.
     *
     * @param $siteHandle
     * @param null $element
     * @param bool $fallbackToHomepage
     * @return mixed
     */
    public function siteSwitcher($siteHandle, $element = null, $fallbackToHomepage = false)
    {
        return SiteSwitcher::$plugin->siteSwitcher->url($siteHandle, $element, $fallbackToHomepage);
    }

    /**
     * Deprecated shortcut to service method.
     *
     * @param $siteHandle
     * @param null $element
     * @return mixed
     * @deprecated in Site Switcher 2.0. Use siteSwitcher() instead.
     */
    public function ll($siteHandle, $element = null)
    {
        Craft::$app->getDeprecator()->log('ll', 'll() has been deprecated. Use siteSwitcher() instead.');
        return $this->siteSwitcher($siteHandle, $element);
    }

}
