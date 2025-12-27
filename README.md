# YouTube Shortcode #

**Contributors:** @lbonomo  
**Donate link:** https://paypal.me/lucasbonomo  
**Tags:** video, shortcode, youtube, embed, responsive  
**Requires at least:** 4.5  
**Tested up to:** 6.6  
**Requires PHP:** 7.2  
**Stable tag:** 2.0.0  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html  

Embed YouTube videos in posts and pages with a powerful, flexible, and accessible shortcode.

## Description ##

YouTube Shortcode is a lightweight WordPress plugin that allows you to embed YouTube videos directly into your posts and pages using a simple shortcode. The plugin supports multiple URL formats, responsive design, and numerous customization options.

### Features ###

- **Multiple Input Formats**: Supports video IDs and various YouTube URL formats
- **Responsive Design**: Automatically adapts to any screen size using CSS aspect ratios
- **Lazy Loading**: Videos are lazy-loaded for better performance
- **Accessibility**: WCAG 2.1 compliant with proper ARIA labels and semantic HTML
- **Customizable**: Control width, height, autoplay, controls, and more
- **Security**: Input sanitization and validation following WordPress standards
- **Translation Ready**: Full i18n support with Spanish translations included
- **Dark Mode Support**: Automatic styling for dark mode preferences
- **Minimal Branding**: Option to hide YouTube logo and related videos

### Shortcode Usage ###

#### Basic Usage (Video ID) ####
```
[youtube-shortcode id="f1nxZBAMpUs"]
```

#### Using Video URL ####
```
[youtube-shortcode url="https://www.youtube.com/watch?v=f1nxZBAMpUs"]
```

#### Short YouTube URL ####
```
[youtube-shortcode url="https://youtu.be/f1nxZBAMpUs"]
```

#### With Custom Dimensions ####
```
[youtube-shortcode id="f1nxZBAMpUs" width="560" height="315"]
```

#### With Autoplay ####
```
[youtube-shortcode id="f1nxZBAMpUs" autoplay="true"]
```

### Shortcode Attributes ###

| Attribute | Type | Default | Description |
|-----------|------|---------|-------------|
| `id` | string | - | YouTube video ID (11 characters). Use either this OR `url`. |
| `url` | string | - | YouTube video URL. Supports youtu.be, youtube.com, and embed URLs. Use either this OR `id`. |
| `width` | string | 100% | Width of the video player. Can be pixels (e.g., "560") or percentage (e.g., "100%"). |
| `height` | string | auto | Height of the video player. Can be pixels or "auto" for responsive 16:9. |
| `autoplay` | boolean | false | Enable autoplay when the video comes into view. Values: true, false |
| `controls` | boolean | true | Show video player controls. Values: true, false |
| `modestbranding` | boolean | true | Minimize YouTube logo and branding. Values: true, false |
| `rel` | boolean | false | Show related videos at the end. Values: true, false |

### Examples ###

**Example 1: Simple Embed**
```
[youtube-shortcode id="9bZkp7q19f0"]
```

**Example 2: Full-Width Responsive Video**
```
[youtube-shortcode url="https://www.youtube.com/watch?v=9bZkp7q19f0" width="100%"]
```

**Example 3: With All Options**
```
[youtube-shortcode id="9bZkp7q19f0" width="560" height="315" autoplay="false" controls="true" modestbranding="true" rel="false"]
```

**Example 4: Minimal Setup**
```
[youtube-shortcode url="https://youtu.be/9bZkp7q19f0"]
```

**Example 5: WooCommerce Product Description**
```
[youtube-shortcode id="9bZkp7q19f0" width="100%" controls="true"]
```

### WooCommerce Integration ###

You can use the YouTube Shortcode plugin to embed product videos in your WooCommerce store. Here's how:

#### Adding a Video to a Product Description ####

1. Go to **Products → All Products** in your WordPress admin
2. Click **Edit** on the product you want to modify
3. In the **Product Data** section, find the **Description** tab
4. Place your cursor where you want to insert the video
5. Add the shortcode:
   ```
   [youtube-shortcode id="YOUR_VIDEO_ID"]
   ```
6. Click **Publish** or **Update** to save changes

#### Adding a Video to Product Short Description ####

1. In the product editor, scroll to the **Short Description** field
2. Add the shortcode there as well:
   ```
   [youtube-shortcode url="https://youtu.be/YOUR_VIDEO_ID"]
   ```
3. Save the product

#### WooCommerce-Specific Examples ####

**Responsive Product Video (Full Width)**
```
[youtube-shortcode id="9bZkp7q19f0" width="100%"]
```

**Product Overview with Custom Size**
```
[youtube-shortcode id="9bZkp7q19f0" width="560" height="315"]
```

**Product Demo with Autoplay (Use with Caution)**
```
[youtube-shortcode url="https://www.youtube.com/watch?v=9bZkp7q19f0" autoplay="false" controls="true"]
```

**Side-by-Side Layout (Using HTML columns)**
```html
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
  <div>[youtube-shortcode id="9bZkp7q19f0"]</div>
  <div>
    <h3>Product Overview</h3>
    <p>Your product description here...</p>
  </div>
</div>
```

#### Tips for WooCommerce ####

- **Performance**: Use `loading="lazy"` (enabled by default) to improve page load times
- **Responsive**: Always use `width="100%"` for mobile compatibility on product pages
- **User Experience**: Disable autoplay (`autoplay="false"`) for better UX
- **Branding**: Use `modestbranding="true"` (default) to minimize YouTube branding on product pages
- **Related Videos**: Set `rel="false"` (default) to avoid showing competitor products
- **Multiple Videos**: You can add multiple shortcodes in the description, they will be responsive
- **Mobile Testing**: Test your product pages on mobile devices to ensure videos display properly

#### Important Notes ####

- Shortcodes in WooCommerce product descriptions work the same way as in regular posts
- Some WooCommerce themes may have custom styling that affects video sizing
- If videos don't display, check if your theme has CSS that conflicts with the plugin
- The plugin works with all WooCommerce-compatible themes

## Installation ##

1. Upload the `youtube-shortcode-lb` directory to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode in your posts: `[youtube-shortcode id="VIDEO_ID"]`

### Manual Installation ###

1. Download the plugin as a ZIP file
2. Go to WordPress admin > Plugins > Add New > Upload Plugin
3. Select the downloaded ZIP file and click "Install Now"
4. Click "Activate Plugin"

## Frequently Asked Questions ##

### Can I use both ID and URL at the same time? ###
No. The shortcode requires either an ID or a URL, but not both. If you provide both, it will display an error message.

### What YouTube URL formats are supported? ###
The plugin supports:
- `https://www.youtube.com/watch?v=VIDEO_ID`
- `https://youtu.be/VIDEO_ID`
- `https://www.youtube.com/embed/VIDEO_ID`

### Is the plugin responsive? ###
Yes! The plugin uses modern CSS with aspect-ratio to maintain a 16:9 ratio on all screen sizes automatically.

### Does it support autoplay? ###
Yes, you can enable autoplay with `autoplay="true"`. Note that browsers may restrict autoplay without user interaction.

### Can I customize the video player size? ###
Yes, use the `width` and `height` attributes. For responsive design, set width to "100%" and height to "auto".

### Is there a performance impact? ###
No. The plugin uses lazy loading (`loading="lazy"`) to improve page performance. Videos only load when they're close to being visible.

### Is it accessible? ###
Yes. The plugin follows WCAG 2.1 guidelines with proper ARIA labels, semantic HTML, and support for keyboard navigation.

## Changelog ##

### 2.0.0 ###
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
* Updated text domain and translations

### 1.0.0 ###
* Initial release
* Basic shortcode functionality
* Support for video ID and URL

## Credits ##

**Author:** Lucas Bonomo  
**Website:** https://lucasbonomo.com/  
**License:** GPLv2 or later

## Support ##

For issues, feature requests, or contributions, please visit the plugin repository.

## Security ##

This plugin follows WordPress security best practices including:
- Input sanitization with `sanitize_text_field()` and `esc_url_raw()`
- Output escaping with `esc_url()` and `esc_attr()`
- Nonce handling where applicable
- Proper capability checks
- WPCS compliance

## Performance ##

The plugin is optimized for performance:
- Lazy loading of videos
- Minimal CSS footprint (~1.5KB)
- No external dependencies
- Efficient JavaScript-free operation
- Conditional style enqueuing only when shortcode is used

---

*Last updated: December 27, 2025*