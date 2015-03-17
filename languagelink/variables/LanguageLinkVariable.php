<?php
namespace Craft;

class LanguageLinkVariable
{

	// Render localized URL for current page
	public function url($localeCode = 'en', $element = null)
	{
		// Get base URL
		$baseUrl = $this->_siteUrl($localeCode);

		// If a current element is specified
		if ($element) {

			// Get element criteria
			$elementType = $element->getElementType();
			$criteria = craft()->elements->getCriteria($elementType);

			// Adjust criteria for target locale
			$criteria->id = $element->id;
			$criteria->locale = $localeCode;

			// Get localized element
			$localeElement = $criteria->first();

			// If localized element exists, return URL
			if ($localeElement) {
				return preg_replace('/__home__/', '', $baseUrl.$localeElement->uri);
			} else {
				return false;
			}

		} else {

			// Get page URI
			$pageUri = craft()->request->path;
			
			// If base URL exists, return URL
			if ($baseUrl) {
				return $baseUrl.$pageUri;
			} else {
				return false;
			}

		}

	}

	// Determine localized site URL
	private function _siteUrl($localeCode)
	{
		$siteUrl = craft()->config->get('siteUrl');

		// siteUrl should be provided as an array:
		// http://buildwithcraft.com/docs/localization-guide#step-4-define-your-site-uRLs

		if (is_string($siteUrl)) {
			return $siteUrl;
		} else if (is_array($siteUrl) && array_key_exists($localeCode, $siteUrl)) {
			return $siteUrl[$localeCode];
		} else {
			return false;
		}
	}
	
}
