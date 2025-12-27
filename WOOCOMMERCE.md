# YouTube Shortcode for WooCommerce

This guide explains how to use the YouTube Shortcode plugin to embed videos in your WooCommerce products.

## Quick Start

### Adding a Video to a Product

1. **Login to WordPress Admin**
2. **Navigate to Products → All Products**
3. **Click Edit on any product**
4. **Scroll to the Description field**
5. **Add the shortcode:**
   ```
   [youtube-shortcode id="YOUR_VIDEO_ID"]
   ```
6. **Click Update** to save the product

That's it! Your video will now display on the product page.

## Finding Your YouTube Video ID

Your YouTube video ID is an 11-character code found in the video URL.

### Examples:

| URL | Video ID |
|-----|----------|
| `https://www.youtube.com/watch?v=f1nxZBAMpUs` | `f1nxZBAMpUs` |
| `https://youtu.be/f1nxZBAMpUs` | `f1nxZBAMpUs` |

## WooCommerce Shortcode Examples

### Basic Product Video
```
[youtube-shortcode id="f1nxZBAMpUs"]
```

### Responsive Full-Width Video
Perfect for modern product pages that display on all devices:
```
[youtube-shortcode id="f1nxZBAMpUs" width="100%"]
```

### Fixed Size Video (YouTube Standard)
For a traditional YouTube embed size:
```
[youtube-shortcode id="f1nxZBAMpUs" width="560" height="315"]
```

### Product Demo with Controls
Explicit control settings:
```
[youtube-shortcode id="f1nxZBAMpUs" controls="true" modestbranding="true"]
```

### Using Video URL Instead of ID
```
[youtube-shortcode url="https://www.youtube.com/watch?v=f1nxZBAMpUs"]
```

Or using the shortened URL:
```
[youtube-shortcode url="https://youtu.be/f1nxZBAMpUs"]
```

### Multiple Videos in One Product
You can add as many videos as you need:

```
<h3>Product Overview</h3>
[youtube-shortcode id="f1nxZBAMpUs"]

<h3>Product Features</h3>
[youtube-shortcode id="abc1234defg"]

<h3>Installation Guide</h3>
[youtube-shortcode id="xyz9876543u"]
```

## Advanced Configurations for WooCommerce

### Recommended Settings for Product Pages

```
[youtube-shortcode 
  id="f1nxZBAMpUs" 
  width="100%" 
  autoplay="false" 
  controls="true" 
  modestbranding="true" 
  rel="false"
]
```

**Why these settings?**
- `width="100%"` - Responsive on all devices
- `autoplay="false"` - Better user experience
- `controls="true"` - Users can control playback
- `modestbranding="true"` - Minimizes YouTube branding
- `rel="false"` - Doesn't show competitor videos

### Side-by-Side Layout (Text + Video)

For a professional product page layout:

```html
<div class="product-media-container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: start;">
  <div class="product-video">
    [youtube-shortcode id="f1nxZBAMpUs" width="100%"]
  </div>
  <div class="product-description">
    <h2>Why Choose This Product?</h2>
    <ul>
      <li>Feature 1</li>
      <li>Feature 2</li>
      <li>Feature 3</li>
    </ul>
  </div>
</div>
```

### Video Gallery with Tabs

If your theme supports tabs, you can organize multiple videos:

**Tab 1: Overview**
```
[youtube-shortcode id="VIDEO_ID_1" width="100%"]
```

**Tab 2: Features**
```
[youtube-shortcode id="VIDEO_ID_2" width="100%"]
```

**Tab 3: Installation**
```
[youtube-shortcode id="VIDEO_ID_3" width="100%"]
```

## WooCommerce Fields Where Shortcodes Work

### 1. Product Description
The main description field - **recommended for detailed product videos**
```
[youtube-shortcode id="f1nxZBAMpUs"]
```

### 2. Product Short Description
The excerpt field - **good for quick product previews**
```
[youtube-shortcode id="f1nxZBAMpUs" width="100%"]
```

### 3. Custom Tabs
If your theme supports custom product tabs:
```
[youtube-shortcode id="f1nxZBAMpUs"]
```

### 4. Product Attributes (with some themes)
Check if your theme allows shortcodes in attribute descriptions.

## Tips & Best Practices

### Performance
- Videos use lazy loading by default - no performance impact
- Multiple videos on a page load only when visible
- Videos are cached by browsers for repeat visits

### Mobile Optimization
- Always test products on mobile devices
- Use `width="100%"` for maximum responsiveness
- Videos maintain 16:9 aspect ratio on all screen sizes
- Ensure sufficient padding around videos on mobile

### User Experience
- Avoid autoplay - it can be annoying and affect loading
- Always include video titles/descriptions in text
- Place videos near relevant product information
- Test video playback quality on different devices
- Consider video length - keep demos under 3 minutes

### SEO Benefits
- Embedded videos improve time-on-page
- Video content can appear in Google video search
- Helps explain products better for customers
- May increase conversion rates

### Accessibility
- Plugin includes WCAG 2.1 compliant features
- Videos work with screen readers
- Keyboard navigation supported
- Dark mode compatible

## Troubleshooting

### Video Not Displaying

**Check 1: Verify Video ID**
- Make sure you're using the 11-character video ID
- Not the full URL - just the ID part
- Example: `f1nxZBAMpUs` (not the whole URL)

**Check 2: Verify YouTube Video**
- Make sure the YouTube video exists and is public
- Private or deleted videos won't display
- Age-restricted videos may not display in some contexts

**Check 3: Check for Theme Conflicts**
- Some WooCommerce themes have CSS conflicts
- Try disabling theme customizations temporarily
- Check browser console for JavaScript errors

**Check 4: Verify Shortcode Syntax**
- Make sure brackets are correct: `[youtube-shortcode ...]`
- No extra spaces in the shortcode
- Attributes use `=""` format

### Video Looks Wrong

**Sizing Issues:**
- Use `width="100%"` for responsive sizing
- Avoid fixed pixel widths if possible
- Test on mobile devices

**Styling Issues:**
- Some themes override video styling
- Check Theme Settings for video player customizations
- Disable theme video enhancements if available

### Video Loads But Won't Play

**Check 1: Browser Compatibility**
- Try a different browser
- Clear browser cache
- Disable ad blockers

**Check 2: YouTube Availability**
- Check if the video is available in your region
- Some videos have regional restrictions
- Check YouTube's status page

## WooCommerce Theme Compatibility

The YouTube Shortcode plugin works with virtually all WooCommerce-compatible themes:

- ✅ Storefront (default WooCommerce theme)
- ✅ Astra
- ✅ Neve
- ✅ OceanWP
- ✅ Flatsome
- ✅ Uncode
- ✅ All custom WooCommerce themes

If you encounter issues with a specific theme, let us know!

## Advanced: Custom CSS for Videos

You can add custom CSS to your theme to style videos further.

### Center Video on Product Page
```css
.yslb-container {
  margin-left: auto;
  margin-right: auto;
}
```

### Add Border Around Video
```css
.yslb-container {
  border: 2px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  padding: 0;
}
```

### Add Shadow Effect
```css
.yslb-container {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
```

## Common Use Cases

### 1. Product Assembly Videos
Help customers understand how to assemble your product:
```
<h3>Assembly Instructions</h3>
[youtube-shortcode id="YOUR_ASSEMBLY_VIDEO" width="100%"]
```

### 2. Product Comparison Videos
Show how your product compares to competitors:
```
<h3>Why We're Better</h3>
[youtube-shortcode id="YOUR_COMPARISON_VIDEO" width="100%"]
```

### 3. Tutorial Videos
Teach customers how to use your product effectively:
```
<h3>How to Use</h3>
[youtube-shortcode id="YOUR_TUTORIAL_VIDEO" width="100%"]
```

### 4. Customer Testimonials
Build trust with customer testimonial videos:
```
<h3>What Our Customers Say</h3>
[youtube-shortcode url="https://youtu.be/YOUR_TESTIMONIAL" width="100%"]
```

### 5. Unboxing Videos
Create excitement with unboxing content:
```
<h3>Unboxing</h3>
[youtube-shortcode id="YOUR_UNBOXING_VIDEO" width="100%"]
```

## Analytics

YouTube videos embedded with this plugin still track views in your YouTube Analytics:

1. Go to youtube.com/analytics
2. You'll see views from your WooCommerce site
3. Track which products generate the most video engagement

This data helps you understand which products interest customers most!

## Support

For issues or questions:
- Check the main plugin README.md
- Review the DEVELOPMENT.md file for technical details
- Visit the plugin repository for more information

## License

This plugin is licensed under GPLv2 or later - free for commercial use!

---

Happy selling with YouTube videos! 🎬🛍️
