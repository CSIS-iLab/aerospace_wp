# aerospace_wp
WordPress site for the Aerospace site.

## Development

### Composer
This project uses [Composer](https://getcomposer.org/) to manage WordPress plugin dependencies.

To install, run `composer install`.

To update dependencies, run `composer update`.

#### Required Plugins
- Add to Any Share
- Akismet
- Disable Comments
- Disable Emojis
- Easy Footnotes
- Google Authenticator
- Guest Authors
- Jetpack
- Search and Filter
- Search by Aloglia
- TinyMCE Advanced
- Yoast SEO

### PHP Codesniffer
This project uses [PHP_CodeSniffer](https://github.com/DealerDirect/phpcodesniffer-composer-installer) that follows the [WordPress Code Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards).

To check files, run `./vendor/bin/phpcs wp-content/themes/aerospace/`.

To fix files, run `./vendor/bin/phpcbf wp-content/themes/aerospace/`.


## Compass
This project uses [Compass](http://compass-style.org/) to compile the SASS files. To run the compiler:
1. Navigate to `wp-content/themes/aerospace` folder
2. Run `compass watch`
