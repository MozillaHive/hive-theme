# Mozilla Hive WordPress Theme

This repo contains the Mozilla Hive WordPress theme used on sites including [Hive NYC](http://hivenyc.org).

For detailed guides to installing and using the theme within your site, see the [GitHub repo wiki](https://github.com/MozillaHive/hive-theme/wiki).

## Requirements

The Hive theme requires the following plugins:
* Advanced Custom Fields <https://wordpress.org/plugins/advanced-custom-fields/>
* Disqus Comment System <https://wordpress.org/plugins/disqus-comment-system/>
* Jetpack <https://wordpress.org/plugins/jetpack/>
* ShareThis <https://wordpress.org/plugins/share-this/>
* WordPress SEO <https://wordpress.org/plugins/wordpress-seo/>
* WordPress Importer <https://wordpress.org/plugins/wordpress-importer/>
* Advanced Custom Fields Repeater <http://www.advancedcustomfields.com/add-ons/repeater-field/> *
* Advanced Post Types Order <http://www.nsp-code.com/premium-plugins/wordpress-plugins/advanced-post-types-order/> *

&#42; _These plugins are premium - if you're developing for a Hive site get in touch via <info@hivenyc.org> for a copy._

## Installation

You can install the theme by downloading the zipped file for this repo. Upload it in WordPress by selecting __Appearance__ &gt; __Themes__ &gt; __Add New__ &gt; __Upload Theme__.

The theme uses custom fields you can import into WordPress from the `hive-custom-fields.xml` file - import using __Tools__ &gt; __Import__ &gt; __WordPress__ &gt; __Upload file and import__. You will then need to map the imported author to a user on your installation.

## Site Structure

The default site structure this theme is designed to work with is as follows:
* a home page with a slider component to display featured articles
 * _articles can be selected by editing the page_
* a blog landing page
* a portfolio page displaying a grid of project pages
 * _each portfolio project page includes custom fields to display data and resources_
* a primary menu which appears at the top and bottom of the site pages
* a social media section in the site header
* a sidebar which appears on blog posts
* a sidebar which appears on other pages

## Configuration

You can add branding to your site in the __Appearance__ &gt; __Theme Options__ section of WordPress.

You can configure the theme's featured articles and portfolio post options in the __Custom Fields__ section of WordPress.
