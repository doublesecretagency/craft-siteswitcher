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

namespace doublesecretagency\siteswitcher;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use doublesecretagency\siteswitcher\services\SiteSwitcherService;
use doublesecretagency\siteswitcher\twigextensions\SiteSwitcherTwigExtension;
use doublesecretagency\siteswitcher\variables\SiteSwitcherVariable;
use yii\base\Event;

/**
 * Class SiteSwitcher
 * @since 2.0.0
 */
class SiteSwitcher extends Plugin
{

    /**
     * @var Plugin Self-referential plugin property.
     */
    public static Plugin $plugin;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // Register components
        $this->_registerService();
        $this->_registerVariable();
        $this->_registerTwigExtension();
    }

    // ========================================================================= //

    /**
     * Register services.
     */
    private function _registerService(): void
    {
        // Load plugin components
        $this->setComponents([
            'siteSwitcher' => SiteSwitcherService::class,
        ]);
    }

    /**
     * Register variables.
     */
    private function _registerVariable(): void
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            static function (Event $event) {
                $variable = $event->sender;
                $variable->set('siteSwitcher', SiteSwitcherVariable::class);
            }
        );
    }

    /**
     * Register Twig extension.
     */
    private function _registerTwigExtension(): void
    {
        // Get request services
        $request = Craft::$app->getRequest();

        // If control panel request, bail
        if ($request->getIsCpRequest()) {
            return;
        }

        // If not a site request, bail
        if (!$request->getIsSiteRequest()) {
            return;
        }

        // Register Twig extension
        Craft::$app->getView()->registerTwigExtension(new SiteSwitcherTwigExtension());
    }

}
