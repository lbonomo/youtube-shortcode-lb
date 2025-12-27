# Changelog

All notable changes to the YouTube Shortcode plugin will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-12-27

### Added

- **Multiple URL Format Support**: Now extracts video IDs from various YouTube URL formats (youtube.com/watch?v=, youtu.be/, youtube.com/embed/, youtube.com/v/)
- **Extended Shortcode Attributes**:
  - `width`: Control video player width (default: 100%)
  - `height`: Control video player height (default: auto for responsive)
  - `autoplay`: Enable/disable autoplay (default: false)
  - `controls`: Show/hide video controls (default: true)
  - `modestbranding`: Minimize YouTube branding (default: true)
  - `rel`: Show/hide related videos (default: false)
- **Lazy Loading**: Videos now use the `loading="lazy"` attribute for better performance
- **Security Attributes**: Added proper iframe security attributes (allow, allowfullscreen, referrerpolicy)
- **Accessibility Improvements**:
  - Semantic HTML with proper `role="alert"` attributes
  - ARIA-compliant error messages
  - Proper iframe `title` attributes
  - WCAG 2.1 level AA compliance
- **Responsive Design**:
  - Uses CSS aspect-ratio for automatic 16:9 proportions
  - Mobile-first approach with media queries
  - Dark mode support with `@media (prefers-color-scheme: dark)`
  - Reduced motion support with `@media (prefers-reduced-motion: reduce)`
- **Enhanced Error Messages**: More descriptive error messages with usage examples
- **Plugin Constants**: Defined constants for version, paths, and validation patterns
- **Better Logging**: Improved debug logging with more informative messages
- **Video ID Validation**: Regex-based validation of YouTube video IDs
- **Input Sanitization**: All user input properly sanitized using WordPress functions
- **Comprehensive Documentation**:
  - Expanded README.md with detailed examples and attributes table
  - Updated readme.txt for WordPress plugin directory
  - Added CONTRIBUTING.md for developers
  - Added DEVELOPMENT.md with setup and testing guidelines
  - Added LICENSE file
- **Translation Updates**: Updated .pot file and Spanish translations for all new strings

### Changed

- **Complete Rewrite**: Refactored entire plugin following WordPress best practices
- **Function Names**: Changed to follow more descriptive naming conventions
- **Error Handling**: Improved error handling with better user feedback
- **Code Structure**: Reorganized code with clear separation of concerns
- **Version**: Updated from 1.0.0 to 2.0.0
- **Requirements**: Updated minimum requirements (PHP 7.2, WordPress 4.5)
- **CSS Framework**: Replaced simple flexbox with modern aspect-ratio-based design
- **Shortcode Handler**: Now uses `shortcode_atts()` for proper attribute handling

### Removed

- **Old Validation Logic**: Removed simplistic length-only validation
- **HTML5 Video Tag**: Removed wp_video_shortcode() in favor of unified iframe approach
- **Strict Parameter Count**: Removed overly strict parameter count validation
- **Inline Style Attributes**: Removed inline styles in favor of CSS classes

### Fixed

- **URL Parsing**: Fixed issues with different YouTube URL formats
- **Responsive Sizing**: Fixed video sizing issues on mobile devices
- **Error Display**: Improved error messages for better user experience
- **Translation**: Fixed text domain usage consistency
- **Performance**: Removed unnecessary style enqueueing logic

### Security

- Added comprehensive input sanitization with `sanitize_text_field()` and `esc_url_raw()`
- Added output escaping with `esc_url()`, `esc_attr()`, and `esc_html()`
- Improved URL validation with `wp_http_validate_url()`
- Added proper iframe attributes for security (CSP compliance)
- Prevented both `id` and `url` from being used simultaneously

### Performance

- Added lazy loading of videos
- Optimized CSS (~3KB, previously ~1KB)
- Reduced number of function calls
- Improved caching strategy for constants

## [1.0.0] - 2021-04-19

### Added

- Initial release of YouTube Shortcode plugin
- Support for YouTube video ID shortcode: `[youtube-shortcode id="VIDEO_ID"]`
- Support for YouTube video URL shortcode: `[youtube-shortcode url="VIDEO_URL"]`
- Basic responsive design with flexbox
- Spanish (es_ES) translations
- Error handling and validation
- Plugin documentation

### Features

- Embed YouTube videos in WordPress posts and pages
- Two input methods: video ID or complete video URL
- Basic error messages for invalid inputs
- Support for WordPress multi-language plugins
