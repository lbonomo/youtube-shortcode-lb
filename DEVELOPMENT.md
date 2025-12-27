/**
 * WordPress Development Configuration Guide
 * 
 * This document provides guidance on setting up a local development environment
 * for the YouTube Shortcode plugin.
 */

# Development Environment Setup

## Requirements

- WordPress 4.5 or higher
- PHP 7.2 or higher
- Modern browser with developer tools

## Local Testing

### Using Local by Flywheel

1. Create a new local site
2. Upload the plugin directory to `wp-content/plugins/`
3. Activate the plugin in WordPress admin

### Using Docker

```bash
docker run -d \
  --name wordpress \
  -p 8000:80 \
  -e WORDPRESS_DB_HOST=db \
  -e WORDPRESS_DB_NAME=wordpress \
  -e WORDPRESS_DB_USER=wordpress \
  -e WORDPRESS_DB_PASSWORD=wordpress \
  wordpress:latest
```

## Code Quality

### PHP CodeSniffer

Check coding standards:
```bash
phpcs --standard=WordPress youtube-shortcode-lb.php
```

Fix issues automatically:
```bash
phpcbf --standard=WordPress youtube-shortcode-lb.php
```

### Debug Mode

Enable WordPress debug mode in `wp-config.php`:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Check logs in `wp-content/debug.log`

## Testing Scenarios

### Video ID Testing
- Test with valid ID: `[youtube-shortcode id="f1nxZBAMpUs"]`
- Test with invalid ID: `[youtube-shortcode id="invalid"]`
- Test with empty ID: `[youtube-shortcode id=""]`

### URL Testing
- youtube.com format: `[youtube-shortcode url="https://www.youtube.com/watch?v=f1nxZBAMpUs"]`
- youtu.be format: `[youtube-shortcode url="https://youtu.be/f1nxZBAMpUs"]`
- embed format: `[youtube-shortcode url="https://www.youtube.com/embed/f1nxZBAMpUs"]`
- Invalid URL: `[youtube-shortcode url="not-a-url"]`

### Responsive Testing
- Test on desktop (1920px)
- Test on tablet (768px)
- Test on mobile (375px)
- Test with different aspect ratios

### Accessibility Testing
- Test with keyboard navigation (Tab key)
- Test with screen reader (NVDA, JAWS, or VoiceOver)
- Check color contrast ratios
- Verify ARIA labels are present

### Performance Testing
- Check lazy loading implementation
- Monitor CSS file size
- Test with multiple videos on one page
- Check for memory leaks with browser DevTools

## Translation Workflow

### Updating Translations

1. Extract translatable strings:
   ```bash
   makepot.php youtube-shortcode-lb.php youtube-shortcode-lb.pot
   ```

2. Create language file:
   ```bash
   cp youtube-shortcode-lb.pot languages/youtube-shortcode-lb-es_ES.po
   ```

3. Edit `.po` file with translation tool (e.g., PoEdit)

4. Compile to `.mo` file:
   ```bash
   msgfmt languages/youtube-shortcode-lb-es_ES.po -o languages/youtube-shortcode-lb-es_ES.mo
   ```

## Version Control

### Git Workflow

1. Create feature branch:
   ```bash
   git checkout -b feature/description
   ```

2. Make changes and commit:
   ```bash
   git commit -m "Add feature description"
   ```

3. Push to remote:
   ```bash
   git push origin feature/description
   ```

4. Create pull request on GitHub

### Commit Message Format

```
[TYPE] Brief description

Longer explanation of the changes made, including:
- What was changed
- Why it was changed
- Any breaking changes

Closes #123
```

Types: FEATURE, BUGFIX, IMPROVEMENT, DOCS, REFACTOR, SECURITY

## Security Considerations

- Always sanitize input with `sanitize_*()` functions
- Always escape output with `esc_*()` functions
- Use nonces for form submissions
- Never trust user input
- Keep WordPress core, plugins, and themes updated
- Use security headers and content security policy
- Test for SQL injection, XSS, CSRF vulnerabilities

## Performance Optimization

- Use lazy loading for images and videos
- Minimize CSS and JavaScript
- Implement caching strategies
- Optimize database queries
- Reduce HTTP requests
- Use Content Delivery Network (CDN)

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest version)
- Mobile browsers (iOS Safari, Chrome Android)

## Release Checklist

- [ ] Update version number in plugin header
- [ ] Update version number in this file
- [ ] Update CHANGELOG in README.md and readme.txt
- [ ] Run code quality checks
- [ ] Test on multiple WordPress versions
- [ ] Test on multiple PHP versions
- [ ] Test on multiple browsers
- [ ] Update translations if needed
- [ ] Create git tag with version
- [ ] Submit to WordPress.org plugin directory

## Support Resources

- WordPress Plugin Developer Handbook: https://developer.wordpress.org/plugins/
- WordPress Coding Standards: https://developer.wordpress.org/coding-standards/
- PHP Manual: https://www.php.net/manual/
- YouTube IFrame API: https://developers.google.com/youtube/iframe_api_reference

---

Last updated: December 27, 2025
