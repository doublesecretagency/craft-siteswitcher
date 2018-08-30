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

use doublesecretagency\siteswitcher\SiteSwitcher;

/**
 * Class SiteSwitcherVariable
 * @since 2.0.0
 */
class SiteSwitcherVariable
{

    /**
     * Render localized URL for current page
     *
     * @param string $siteHandle
     * @param null $element
     * @return mixed
     */
    public function url($siteHandle = null, $element = null)
    {
        return SiteSwitcher::$plugin->siteSwitcher->url($siteHandle, $element);
    }

}
