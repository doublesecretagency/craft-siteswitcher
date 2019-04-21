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

namespace doublesecretagency\siteswitcher\services;

use Craft;
use craft\base\Component;
use craft\base\Element;
use craft\errors\SiteNotFoundException;
use craft\helpers\UrlHelper;
use yii\base\Exception;
use yii\base\InvalidConfigException;

/**
 * Class SiteSwitcherService
 * @since 2.0.0
 */
class SiteSwitcherService extends Component
{

    /**
     * Render localized URL for current page.
     *
     * @param null $siteHandle
     * @param null $element
     * @return bool|string
     * @throws SiteNotFoundException
     */
    public function url($siteHandle = null, $element = null)
    {
        // If no site handle specified, use the default site
        if (!$siteHandle) {
            $siteHandle = Craft::$app->getSites()->getPrimarySite()->handle;
        }

        // If element is specified, return element URL
        if ($element) {
            return $this->_getElementUrl($siteHandle, $element);
        }

        // Return non-element URL
        return $this->_getNonElementUrl($siteHandle);
    }

    /**
     * Get localized element URL.
     *
     * @param string $siteHandle
     * @param Element $element
     * @return bool
     */
    private function _getElementUrl($siteHandle, Element $element)
    {
        // If element is not localized, bail
        if (!$element->isLocalized()) {
            return false;
        }

        // Get localized element
        $localeElement = $element::find()
            ->id($element->id)
            ->site($siteHandle)
            ->one();

        // If no localized element exists, bail
        if (!$localeElement) {
            return false;
        }

        // Return localized element URL
        return $localeElement->getUrl();
    }

    /**
     * Get localized non-element URL.
     *
     * @param $siteHandle
     * @return bool|string
     * @throws Exception
     * @throws InvalidConfigException
     */
    private function _getNonElementUrl($siteHandle)
    {
        // Get specified site
        $site = Craft::$app->getSites()->getSiteByHandle($siteHandle);

        // If no site, bail
        if (!$site) {
            return false;
        }

        // Get page URI
        $pageUri = Craft::$app->getRequest()->getUrl();

        // Return localized non-element URL
        return UrlHelper::siteUrl($pageUri, null, null, $site->id);
    }

}
