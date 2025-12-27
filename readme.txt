=== YouTube Shortcode ===
Contributors: lbonomo
Donate link: https://paypal.me/lucasbonomo
Tags: video, shortcode, youtube, embed, responsive, accessibility, lazy-loading
Requires at least: 4.5
Tested up to: 6.6
Requires PHP: 7.2
Stable tag: 2.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Embed YouTube videos in posts and pages with a powerful, flexible, and accessible shortcode.

== Description ==

YouTube Shortcode is a lightweight WordPress plugin that allows you to embed YouTube videos directly into your posts and pages using a simple shortcode. The plugin supports multiple URL formats, responsive design, and numerous customization options.

= Features =

* Multiple Input Formats - Supports video IDs and various YouTube URL formats
* Responsive Design - Automatically adapts to any screen size using CSS aspect ratios
* Lazy Loading - Videos are lazy-loaded for better performance
* Accessibility - WCAG 2.1 compliant with proper ARIA labels and semantic HTML
* Customizable - Control width, height, autoplay, controls, and more
* Security - Input sanitization and validation following WordPress standards
* Translation Ready - Full i18n support with Spanish translations included
* Dark Mode Support - Automatic styling for dark mode preferences
* Minimal Branding - Option to hide YouTube logo and related videos

= Basic Usage =

`[youtube-shortcode id="f1nxZBAMpUs"]`

or

`[youtube-shortcode url="https://www.youtube.com/watch?v=f1nxZBAMpUs"]`

= Shortcode Attributes =

* id - YouTube video ID (11 characters). Use either this OR url.
* url - YouTube video URL. Supports youtu.be and youtube.com URLs.
* width - Width of the video player (default: 100%)
* height - Height of the video player (default: auto for responsive)
* autoplay - Enable autoplay (true/false, default: false)
* controls - Show video controls (true/false, default: true)
* modestbranding - Minimize YouTube branding (true/false, default: true)
* rel - Show related videos (true/false, default: false)

== Installation ==

1. Upload the `youtube-shortcode-lb` directory to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode in your posts: [youtube-shortcode id="VIDEO_ID"]

== WooCommerce Integration ==

You can use YouTube Shortcode to embed product videos in your WooCommerce store!

= Adding a Video to a Product Description =

1. Go to Products → All Products in WordPress admin
2. Click Edit on the product
3. In the Description field, add the shortcode:
   `[youtube-shortcode id="YOUR_VIDEO_ID"]`
4. Save the product

= WooCommerce Examples =

* Responsive product video: `[youtube-shortcode id="9bZkp7q19f0" width="100%"]`
* Product demo with controls: `[youtube-shortcode url="https://youtu.be/9bZkp7q19f0" controls="true"]`
* Minimal branding: `[youtube-shortcode id="9bZkp7q19f0" modestbranding="true" rel="false"]`

= Tips for WooCommerce =

* Use width="100%" for responsive product pages
* Disable autoplay for better user experience (autoplay="false" is default)
* Use modestbranding="true" to minimize YouTube branding
* Set rel="false" to avoid showing competitor products
* Videos are lazy-loaded for better performance
* All videos are responsive and mobile-friendly
* Test videos on mobile devices to ensure proper display

== Frequently Asked Questions ==

= Can I use both ID and URL at the same time? =
No. The shortcode requires either an ID or a URL, but not both.

= What YouTube URL formats are supported? =
The plugin supports youtube.com/watch?v=, youtu.be/, and youtube.com/embed/ URLs.

= Is the plugin responsive? =
Yes! The plugin maintains a 16:9 aspect ratio on all screen sizes.

= Does it support autoplay? =
Yes, use autoplay="true" attribute.

= Is it accessible? =
Yes. The plugin follows WCAG 2.1 guidelines with proper ARIA labels.

= Can I use this in WooCommerce products? =
Yes! Use the shortcode in the product description field just like you would in a regular post.

= Will videos work on mobile? =
Yes! All videos are responsive and work perfectly on mobile devices.

== Screenshots ==

1. Basic YouTube video embed with responsive design
2. Error message with helpful usage examples
3. Support for multiple YouTube URL formats
4. WooCommerce product page with embedded video

== Changelog ==

= 2.0.0 =
* Complete rewrite following WordPress best practices
* Added support for multiple YouTube URL formats
* New customizable attributes: width, height, autoplay, controls, modestbranding, rel
* Improved responsive design with CSS aspect-ratio
* Added lazy loading for better performance
* Enhanced accessibility (WCAG 2.1 compliant)
* Improved error messages and debugging
* Added dark mode support
* Better input sanitization and validation
* Reduced motion support for accessibility
* Comprehensive inline documentation

= 1.0.0 =
* Initial release
* Basic shortcode functionality

== Upgrade Notice ==

= 2.0.0 =
Major update with many new features, improved security, and better accessibility. Strongly recommended for all users.

== Support ==

For support and more information, visit https://lucasbonomo.com/

== License ==

This plugin is licensed under the GPLv2 or later license.
See license.txt for more details.