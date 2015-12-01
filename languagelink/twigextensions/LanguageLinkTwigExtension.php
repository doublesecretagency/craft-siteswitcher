<?php

namespace Craft;

use Twig_Extension;
use Twig_SimpleFunction;

class LanguageLinkTwigExtension extends Twig_Extension
{

	public function getName()
	{
		return 'Language Link';
	}

	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('ll', array($this, 'll')),
		);
	}

	public function ll($localeCode = 'en', $element = null)
	{
		return craft()->languageLink->url($localeCode, $element);
	}

}
