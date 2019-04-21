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
     * @param string|null $siteHandle
     * @param Element|null $element
     * @return bool|string
     * @throws Exception
     * @throws InvalidConfigException
     * @throws SiteNotFoundException
     */
    public function url($siteHandle = null, Element $element = null)
    {
        // If no site handle specified, use the default site
        if (!$siteHandle) {
            $siteHandle = Craft::$app->getSites()->getPrimarySite()->handle;
        }

        // If element is specified
        if ($element) {
            // Get element URL
            $siteLink = $this->_getElementUrl($siteHandle, $element);
        } else {
            // Get non-element URL
            $siteLink = $this->_getNonElementUrl($siteHandle);
        }

        // Get query string
        $queryString = Craft::$app->getRequest()->getQueryStringWithoutPath();

        // If site link is valid and query string exists, append query string
        if ($siteLink && $queryString) {
            $siteLink .= "?{$queryString}";
        }

        // Return site link
        return $siteLink;
    }

    /**
     * Get localized element URL.
     *
     * @param string $siteHandle
     * @param Element $element
     * @return string|bool
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
        $pageUri = Craft::$app->getRequest()->getPathInfo();

        // Return localized non-element URL
        return UrlHelper::siteUrl($pageUri, null, null, $site->id);
    }

}
