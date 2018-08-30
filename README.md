Site Switcher plugin for Craft CMS
==================================

Easily switch between sites on any page of your website.

***

**The plugin formerly known as "Language Link".**

## About

This plugin provides an easy way to switch between sites on your website. Regardless of which page you are currently on, you will be linked to the same page in its parallel site.

_* Note: You must be using Craft's [multi-site](https://craftcms.com/features/multi-site) feature to access multiple languages on your website._

***

## The Twig Function

```twig
siteSwitcher(siteHandle, element = null)
```

 - `siteHandle` - The handle of your site (ie: `english`).
 - `element` - _(optional)_ If the current page is an `entry` (or another element type), you can pass that element in as the second parameter. This ensures that any translated slugs are properly used.

Returns a URL which links to the alternate-site version of the current page. If the `siteHandle` or `element` is invalid, `false` will be returned instead.

## Basic Usage

Simply use a line of code like this:

```twig
<a href="{{ siteSwitcher('spanish') }}">Español</a>
```

That will link you to the Spanish version of the current page.

## Advanced Usage

If the current page is an entry, your entry might be using different slugs for each language. In that case, you can pass the `entry` object as your second parameter:

```twig
<a href="{{ siteSwitcher('spanish', entry) }}">Español</a>
```

That second parameter can accept any Craft element type, so you can use other elements as well! Obviously, only elements which make use of slugs (like `category` elements) will work.

```twig
<a href="{{ siteSwitcher('spanish', category) }}">Español</a>
```

### Sharing site links between entries & non-entries

Using the [null-coalescing operator](https://twig.symfony.com/doc/2.x/templates.html#other-operators), you can chain potential element types. If one isn't defined on a particular page, the next value will be used.

```twig
{% set element = (category ?? entry ?? null) %}
```

This will use the first non-null value it finds (or null if no element exists).

***

## In Conclusion

A simple piece of code like this one will work great across 99% of sites:

```twig
{% set element = (category ?? entry ?? null) %}

<ul>
    <li><a href="{{ siteSwitcher('english', element) }}">English</a></li>
    <li><a href="{{ siteSwitcher('spanish', element) }}">Español</a></li>
    <li><a href="{{ siteSwitcher('french', element) }}">Français</a></li>
    <li><a href="{{ siteSwitcher('german', element) }}">Deutsch</a></li>
</ul>
```

You can use this code in an `include`, and share it across your entire website. If the page is an `entry` page, it will use the localized version of that entry's slug. Otherwise, it will simply retain the same URI for each link.

If you want to dynamically loop through each of your sites, try this instead:

```twig
{% set element = (category ?? entry ?? null) %}

<ul>
    {% for site in craft.app.sites.getAllSites() %}
        <li><a href="{{ siteSwitcher(site.handle, element) }}">{{ site.name }}</a></li>
    {% endfor %}
</ul>
```

***

## Anything else?

We've got other plugins too!

Check out the full catalog at [doublesecretagency.com/plugins](https://www.doublesecretagency.com/plugins)
