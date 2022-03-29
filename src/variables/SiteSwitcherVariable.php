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

namespace doublesecretagency\siteswitcher\variables;

use Craft;
use craft\base\Element;
use doublesecretagency\siteswitcher\SiteSwitcher;

/**
 * Class SiteSwitcherVariable
 * @since 2.0.0
 */
class SiteSwitcherVariable
{

    /**
     * Render localized URL for current page.
     *
     * @param null|string $siteHandle
     * @param null|Element $element
     * @param bool $fallbackToHomepage
     * @return null|string
     * @deprecated in 2.3.0. Use `siteSwitcher()` instead.
     */
    public function url(?string $siteHandle = null, ?Element $element = null, bool $fallbackToHomepage = false): ?string
    {
        Craft::$app->getDeprecator()->log('craft.siteSwitcher.url()', 'craft.siteSwitcher.url() has been deprecated. Use siteSwitcher() instead.');
        return SiteSwitcher::$plugin->siteSwitcher->url($siteHandle, $element, $fallbackToHomepage);
    }

}
