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

use yii\base\Event;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use doublesecretagency\siteswitcher\services\SiteSwitcherService;
use doublesecretagency\siteswitcher\twigextensions\SiteSwitcherTwigExtension;
use doublesecretagency\siteswitcher\variables\SiteSwitcherVariable;

/**
 * Class SiteSwitcher
 * @since 2.0.0
 */
class SiteSwitcher extends Plugin
{

    /** @var Plugin $plugin Self-referential plugin property. */
    public static $plugin;

    /** @inheritDoc */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Load plugin components
        $this->setComponents([
            'siteSwitcher' => SiteSwitcherService::class,
        ]);

        // Register variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                $variable = $event->sender;
                $variable->set('siteSwitcher', SiteSwitcherVariable::class);
            }
        );

        // If control panel request, bail
        if (Craft::$app->getRequest()->getIsCpRequest()) {
            return;
        }

        if (Craft::$app->getRequest()->getIsSiteRequest()) {
            Craft::$app->getView()->registerTwigExtension(new SiteSwitcherTwigExtension());
        }

    }

}
