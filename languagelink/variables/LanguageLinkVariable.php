<?php
namespace Craft;

class LanguageLinkVariable
{

	// Render localized URL for current page
	public function url($localeCode = 'en', $element = null)
	{
		return craft()->languageLink->url($localeCode, $element);
	}

}
