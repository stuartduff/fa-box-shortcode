=== Font Awesome Box Shortcode ===
Contributors: stuartduff
Tags: shortcode, shortcodes, info boxes, infobox, feature box, font icon, font-awesome, fontawesome, icon font, icons
Requires at least: 4.6
Tested up to: 4.7.2
Stable tag: 1.0.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

The Font Awesome box shortcode plugin adds slim information box style shortcodes to your WordPress site which support displaying any of the Font Awesome icons.

== Description ==

The Font Awesome Box Shortcode plugin adds slim information box style shortcodes to your WordPress site and which supports displaying any of the Font Awesome Icons.

See the [Other Notes](https://wordpress.org/plugins/fa-box-shortcode/other_notes/) page for useage instructions.

== Minimum Requirements ==

For this extension to function [WordPress](https://wordpress.org/) must be installed.

## FAQ

> How do I use the shortcodes.

From the WordPress visual editor you can add a shortcode via the box shortcode icon.

To use the plugin manually insert the shortcode below into your WordPress post or page content area.

```
[box icon="fa-wordpress" color="blue" url="https://wordpress.org"]Visit WordPress.org[/box]
```

The shortcode accepts two parameters of `icon=""` and `url=""` which are explained below.

The `icon=""` parameter will accept any Font Awesome icon code which looks like this `fa-warning` as an example

For a full list of all the icons you can use within the shortcode these are available with the relevant codes on the [Font Awesome Cheat Sheet](http://fontawesome.io/cheatsheet/).

The `url=""` parameter will accept any url internal or external url you add to it.

The `color=""` parameter allows you to choose one of the predefined colors listed below

Also don't forget to add some text content between the shortcode containers too!


> How can I disable the plugins default font awesome stylesheet as my theme is loading it's own?

There is a filter inside the Font Awesome Box Shortcode plugin titled `enqueued_fabs_font_awesome_filter` which you can use to specify your themes enqueued version of Font Awesome which will then disable the plugin version from loading.

If your themes loaded version of font awesome has been enqueued as `font-awesome` then you don't need to use any filters as the plugin will detect that loaded script and not load it's own version of the Font Awesome stylesheet from MAX CDN.

If your existing loaded version of Font Awesome has been enqueued under a different name like `my_themes_fontawesome` as an example then you would have to use the filter below to specify the name under which your current version was being enqueued.

https://gist.github.com/stuartduff/4c0c21ff924a013db5d7a1a66910b33b

== Changelog ==

= 1.0.1 - 14/02/17 =
* Update - updated font awesome version to v4.7.0.

= 1.0.0 - 15/10/16 =
* Initial Release - first version of the plugin released.
