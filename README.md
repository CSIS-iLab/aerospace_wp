[![Build Status](https://travis-ci.org/CSIS-iLab/aerospace_wp.svg?branch=master)](https://travis-ci.org/CSIS-iLab/aerospace_wp)

# aerospace_wp
WordPress site for [Aerospace Security](https://aerospace.csis.org). Developed from the [_s starter theme](http://underscores.me).

## Contributing
1. New features & updates should be created on individual branches. Branch from `master`
2. When ready, submit pull request back into `master`. Rebase the feature branch first.
3. TravisCI will automatically deploy changes on `master` to the staging site
4. After reviewing your work on the staging site, use WPEngine to move from staging to live

## Development
### Composer
This project uses [Composer](https://getcomposer.org/) to manage WordPress plugin dependencies.

To install, run `composer install`.

To update dependencies, run `composer update`.

#### Required Plugins
- Accordion Shortcodes
- Archive Control
- Add to Any Share
- Akismet
- Disable Comments
- Disable Emojis
- Easy Footnotes
- Google Authenticator
- Guest Authors
- Jetpack
- Menu Item Custom Fields
- Related
- Search by Aloglia
- SVG Support
- TinyMCE Advanced
- WP DataTables (Premium)
- Yoast SEO

### PHP Codesniffer
This project uses [PHP_CodeSniffer](https://github.com/DealerDirect/phpcodesniffer-composer-installer) that follows the [WordPress Code Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards).

To check files, run `./vendor/bin/phpcs wp-content/themes/aerospace/`.

To fix files, run `./vendor/bin/phpcbf wp-content/themes/aerospace/`.


## Compass
This project uses [Compass](http://compass-style.org/) to compile the SASS files. To run the compiler:
1. Navigate to `wp-content/themes/aerospace` folder
2. Run `compass watch`
