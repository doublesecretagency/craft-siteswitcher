# Language Link plugin for Craft CMS

_Easily switch between languages on any page of your website!_

## About

This plugin provides an easy way to switch between languages on your website. Regardless of which page you are currently on, you will be linked to the _same_ page in a different language.

_* Note: You must be using Craft's [localization feature](https://buildwithcraft.com/features/localization) to access multiple languages on your website. Localization requires a Craft Pro license._

## Craft Variable

    craft.languageLink.url(localeId, element = null)

 - `localeId` - There are two accepted locale ID formats (`en` or `en_us`).
 - `element` - _(optional)_ If the current page is an `entry` (or another element type), you can pass that element in as the second parameter. This ensures that any translated slugs are properly used.

Returns a URL which links to the alternate-language version of the current page. If the `localeId` or `element` is invalid, `false` will be returned instead.

## Basic Usage

Simply use a line of code like this:

    <a href="{{ craft.languageLink.url('es') }}">Español</a>

That will link you to the Spanish version of the current page.

## Advanced Usage

If the current page is an entry, your entry might be using different slugs in each language. In that case, you can pass the `entry` object as your second parameter:

    <a href="{{ craft.languageLink.url('es', entry) }}">Español</a>

That second parameter can accept any Craft element type, so you can use other elements as well! Obviously, only elements which make use of slugs (like `category` elements) will work.

    <a href="{{ craft.languageLink.url('es', category) }}">Español</a>


### Sharing language links between entries & non-entries

Just make sure you add a conditional to check if `entry` is defined:

    {% if entry is not defined %}
        {% set entry = null %}
    {% endif %}

This will save you from getting errors on non-entry pages.

## In Conclusion

A simple piece of code like this one will work great across 99% of sites:

    {% set element = (entry is defined ? entry : null) %}
    
    <ul>
        <li><a href="{{ craft.languageLink.url('en', element) }}">English</a></li>
        <li><a href="{{ craft.languageLink.url('es', element) }}">Español</a></li>
        <li><a href="{{ craft.languageLink.url('fr', element) }}">Français</a></li>
        <li><a href="{{ craft.languageLink.url('de', element) }}">Deutsch</a></li>
    </ul>

You can use this code in an `include`, and share it across your entire website. If the page is an `entry` page, it will use the localized version of that entry's slug. Otherwise, it will simply retain the same URI for each link.

If you want to create a dynamic loop through each of your locales, try this instead:

    {% set element = (entry is defined ? entry : null) %}
    
    <ul>
        {% for locale in craft.i18n.getSiteLocales %}
            <li><a href="{{ craft.languageLink.url(locale.id, element) }}">{{ locale.nativeName|capitalize }}</a></li>
        {% endfor %}
    </ul>
