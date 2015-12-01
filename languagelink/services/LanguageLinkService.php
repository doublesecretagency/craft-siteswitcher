<?php
namespace Craft;

class LanguageLinkService extends BaseApplicationComponent
{

	// Render localized URL for current page
	public function url($localeCode = 'en', $element = null)
	{
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
				return $this->_compileUrl($localeElement->uri, $localeCode);
			} else {
				return false;
			}

		} else {

			// Get base URL
			$baseUrl = $this->_siteUrl($localeCode);

			// Get page URI
			$pageUri = craft()->request->path;

			// If base URL exists, return URL
			if ($baseUrl) {
				return $this->_compileUrl($pageUri, $localeCode);
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

	/**
	 * Compile full URL
	 *
	 * @param string $pageUri
	 * @param string $localeCode
	 *
	 * @return string
	 */
	private function _compileUrl($pageUri, $localeCode)
	{
		// Get config values
		$pageTrigger   = craft()->config->get('pageTrigger');
		$trailingSlash = craft()->config->get('addTrailingSlashesToUrls');

		// Set URL components
		$baseUrl = $this->_siteUrl($localeCode);
		$pageUri = preg_replace('/__home__/', '', $pageUri);

		// If not the home page
		if ('' != $pageUri) {

			// Ensure trailing slash on base URL
			$baseUrl = rtrim($baseUrl, '/').'/';

			// Remove leading slash from page URI
			$pageUri = ltrim($pageUri, '/');

			// If trailing slash, append to URI
			if ($trailingSlash) {
				$pageUri = rtrim($pageUri, '/').'/';
			}

		}

		// Compile full URL
		$fullUrl = $baseUrl.$pageUri;

		// Get query string
		$queryString = craft()->request->getQueryStringWithoutPath();

		// If query string, append it to URL
		if ($queryString) {
			$fullUrl .= '?'.$queryString;
		}

		// Return full URL
		return $fullUrl;
	}

}