# Font Awesome Box Shortcode
The Font Awesome box shortcode plugin adds slim information box style shortcodes to your WordPress site which support displaying any of the Font Awesome icons.

## Installation

1. Download the plugin from WordPress.org [Font Awesome Box Shortcode](https://wordpress.org/plugins/fa-box-shortcode/).
2. Goto WordPress > Appearance > Plugins > Add New.
3. Click Upload Plugin and Choose File, then select the plugin's .zip file. Click Install Now.
4. Click Activate to use your new plugin right away.

## Minimum Requirements

For this extension to function [WordPress](https://wordpress.org/) must be installed.

## Usage Instructions

From the WordPress visual editor you can add a shortcode via the box shortcode icon.

To use the plugin insert the shortcode below into your WordPress post or page content area.

```
[box icon="fa-wordpress" color="blue" url="https://wordpress.org"]Visit WordPress.org[/box]
```

The shortcode accepts three parameters of `icon=""`, `color=""`, `url=""` which are explained below.

The `icon=""` parameter will accept any Font Awesome icon code which looks like this `fa-warning` as an example

For a full list of all the icons you can use within the shortcode these are available with the relevant codes on the [Font Awesome Cheat Sheet](https://fontawesome.com/v4.7.0/cheatsheet/).

The `url=""` parameter will accept any url internal or external url you add to it.

The `color=""` parameter allows you to choose one of the predefined colors from the visual editor shortcode modal box.

Also don't forget to add some content between the shortcode containers too!

## FAQ

> How can I disable the plugins default awesome stylesheet as my theme is loading it's own?

There is a filter inside the Font Awesome Box Shortcode plugin titled `enqueued_fabs_font_awesome_filter` which you can use to specify your themes enqueued version of Font Awesome which will then disable the plugin version from loading.

If your themes loaded version of font awesome has been enqueued as `font-awesome` then you don't need to use any filters as the plugin will detect that loaded script and not load it's own version of the Font Awesome stylesheet from MAX CDN.

If your existing loaded version of Font Awesome has been enqueued under a different name like `my_themes_fontawesome` as an example then you would have to use the filter below to specify the name under which your current version was being enqueued.

https://gist.github.com/stuartduff/4c0c21ff924a013db5d7a1a66910b33b

## Changelog

**1.0.1 - 14/02/17**
* Update - updated font awesome version to v4.7.0.

**1.0.0 - 15/10/16**
* Initial Release - first version of the plugin released.
