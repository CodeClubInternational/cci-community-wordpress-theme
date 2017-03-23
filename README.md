# Code Club International Country/Community Base WordPress Theme

This is a WordPress theme designed to help coordinators build a site to service their community.

**Note:** this theme and accompanying documentation are in their early stages. Many changes and improvements will be made. You're encouraged to provide feedback and log issues via the Issues feature attached to this repository as well as provide fixes and new features via Pull Requests.

#### Table of Contents
* [General Info](#general-info)
* [Setup](#setup)
* [Assets](#assets)
* [Menus](#menus)
* [Localisation / Translation](#localisation--translation)
* [Use of the CCW API](#use-of-the-ccw-api)
* [Contributing](#contributing)
* [Legal Stuff](#legal-stuff)

## General Info

The theme sets up some basic templates and a set of styles that should cover the majority of use-cases required by a community site in its infancy. Styling is based off the [official Code Club style guide](https://styleguide.codeclubworld.org).

In order to work with this theme and build a content-managed WordPress site, it's expected that you have at least some experience of creating WordPress themes (HTML and at least some PHP knowledge assumed) and are familiar with setting up WordPress in a local development environment as well as in a hosted environment. Additional experience of the Advanced Custom Fields plugin for WordPress is a bonus but not required.

## Setup

### Install WordPress

The best resource is the [WordPress Codex](https://codex.wordpress.org/Installing_WordPress). When installing in a hosted environment, you'll need an appropriate account with a web hosting provider (linked with the relevant domain name) as well (we'll have a short list of recommended hosting providers ready soon).

WordPress' minimum requirements can be found here: https://codex.wordpress.org/Hosting_WordPress and whilst it's stated that PHP 5.2.4 is the minimum, we would strongly suggest at least PHP 5.3 (>= 5.5 is even better).

It's very important to ensure that your WordPress installation is kept up-to-date at all times and that a regular (and secure) backup of your data is made.

### Install the ACF Pro Plugin

The Advanced Custom Fields Pro plugin is required for the theme to function as intended. You can download it here: http://downloads.codeclubworld.org/wp-advanced-custom-fields-pro.zip

Once you have the plugin ZIP file, extract it and place the resulting directory in your WordPress installation's `wp-content/plugins` directory. Then:

* Log in to the WordPress Administration panel (usually http://yoursiteurl/wp-admin)
* Select the Plugins panel, then click on 'Activate' beneath 'Advanced Custom Fields Pro'

### Install the Theme

Download the `Source code (zip)` file from the latest release on the [releases page](https://github.com/CodeClub/ccw-countries-wordpress-theme/releases).

Once you have the ZIP file, extract it and place the resulting directory in your WordPress installation's `wp-content/themes` directory. Then:

* Log in to the WordPress Administration panel (usually http://yoursiteurl/wp-admin).
* Select the Appearance panel, then Themes.
* You'll see the 'CCW Countries' listed, select it and click on Activate.

Making changes to the theme itself is the most basic way to get started, however it is *highly* recommended that instead of modifying the source theme, you utilise a child theme instead. This will allow you to make changes / additions to your theme without modifying the source theme (ie. this one) in any way, allowing it to be overwritten easily as and when we publish updates.

The full WordPress child theme documentation is available here: https://codex.wordpress.org/Child_Themes but the main steps are:

* Create a new folder within the `wp-content/themes` directory and name it whatever you'd like your theme to be called eg. `ccw-child-theme`.
* Within `ccw-child-theme` create the file `style.css` and place the following inside:
```
/*
 Theme Name:   CCW Countries Child Theme
 Theme URI:
 Description:  A child theme based on the CCW Countries theme
 Template:     ccw-countries-wordpress-theme
 Version:      1.0.0
 Text Domain:  ccw-child-theme
*/
```
* Within `ccw-child-theme` create the file `functions.php` and place the following inside:
```
<?php
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );
function child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
```
* In the WordPress admin, go to Appearance > Themes and activate the theme `CCW Countries Child Theme`

That's all! (don't forget to read the docs for extra info and path-related caveats: https://codex.wordpress.org/Child_Themes)

You can now add new files as you wish but also override files that exist in the parent theme (such as `template-home.php`) by simply duplicating them in your child theme's folder and modifying them there.

### Upload the Setup Data

Within the theme folder (that was unzipped in the initial steps above) there's a `setup` directory. This contains some starter data for WordPress and for the ACF plugin. They need to both be imported:

* Log in to the WordPress Administration panel.
* Select the Tools panel, then Import.
* Select 'WordPress' from the import list (install the Importer plugin if prompted and select 'Activate Plugin and Run Importer' when complete) then select 'Browse' and point it to the `pages-export.xml` file within the theme's `setup` directory. Select 'Upload file and import'
* When prompted to 'Assign Authors', select the username 'admin' from the dropdown option under 'or assign posts to an existing user' in step 1. Then click on Submit.
* When complete, head to the Custom Fields panel, then Tools.
* Under 'Import Field Groups' browse to the `acf-export.json` file within the theme's `setup` directory, then select Import.

A page called 'Home' will have been created (using the `template-home.php` file) with example ACF fields attached to it (visit http://yoursiteurl/home to see it). Try adding some new fields via ACF's Field Groups panel and outputting them in the template (see the ACF documentation: https://www.advancedcustomfields.com/resources/get_field/). WordPress' templating help documents can be found here: https://developer.wordpress.org/themes/basics/

To set the 'Home' page to be the one that appears by default when viewing the root of your site (eg. at http://yoursiteurl rather than at http://yoursiteurl/home):

* In the WordPress admin, head to Settings > Reading
* Under 'Front page displays' select 'A static page' and then set 'Front page' to 'Home'
* Click on 'Save Changes'

## Assets

### Sass / CSS

The themes styles can be found in the `sass` directory. After any changes to Sass files, `sass/style.scss` needs to be compiled to create `style.css`:

* Ensure you have Sass installed: http://sass-lang.com/install
* Run `sass sass/style.scss style.css` from within the theme directory

There are a number of command line tools and GUIs to make this process even easier / automatic (see links on the Sass installation page: http://sass-lang.com/install).

### Images

It's recommended that you create a directory in the root of the theme folder called `images` and refer to it in templates using `<?php echo get_template_directory_uri(); ?>/images/image-name.jpg` eg:

```
<img src="<?php echo get_template_directory_uri(); ?>/images/image-name.jpg" alt="" />
```

**Note:** if using a child theme, replace `get_template_directory_uri()` with `get_stylesheet_directory_uri()`

### Favicons

Paths to favicons are set in `header.php` (these favicons need to be created and placed in the `images` dir, see above):

```
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" sizes="32x32">
```

You may use the style guide assets for guidance, see: `bower_components/code-club/dist/images/favicons`

### Fonts

Museo Sans Rounded is used throughout (at varying weights) and is served via the CCW Typekit account using this snippet in `header.php`:

```
<script src="https://use.typekit.net/hos3npy.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
```

However, since Typekit performs domain name checks against a whitelist before serving any assets, fonts on your site won't be loaded until you inform the CCW team of the domain names you will be using (eg. `codeclub.org.uk`, `test.codeclub.org.uk`, `dev.codeclub.org.uk`) and we add them to Typekit's whitelist, so please let us know!

## Menus

There are five single-level menu locations defined in this theme:

* 1 Primary menu (horizontal, in header)
* 4 Footer menus (vertical, in columns within footer)

See https://styleguide.codeclubworld.org/example-pages/stacked-content for examples of each.

Menu contents are managed via the WordPress admin. To create a new menu and assign it to one of the above locations:

* Head to Appearance > Menus in the WordPress admin
* Click on 'create a new menu'
* Enter a name (such as 'Main' or 'Footer 1') and click on 'Create Menu'
* Add pages / items to the new menu using the panel on the left (for more info, see: https://codex.wordpress.org/WordPress_Menu_User_Guide)
* Click on the 'Manage Locations' tab above and assign the menu to one of the five locations. Click on 'Save Changes'

The new menu should now appear in the appropriate place and its items can continue to be modified / added to via the 'Edit Menus' tab.

### Social Links

In addition to the menus, social links can be output in the footer. To enable, uncomment and add your links to the relevant social link `define` lines in `inc/country-config.php`. Upon doing so, the social icons will appear in the lower right of the footer (eg. https://styleguide.codeclubworld.org/example-pages/stacked-content)

## Localisation / Translation

The theme (and thus a child theme) is prepared for translation. This is performed via 'POT' files within the `languages` folder (we recommend using the program [Poedit](http://poedit.net) to create and manage `.pot` files).

See the WordPress guide for more information: https://developer.wordpress.org/themes/functionality/localization/ along with this tutorial: https://premium.wpmudev.org/blog/how-to-translate-a-wordpress-theme

In particular, the club registration form (`template-parts/form-register-club.php`) and the 404 page (`404.php`) contain strings requiring translation.

Right-to-left languages are supported via the `rtl.css` file. See https://codex.wordpress.org/Right_to_Left_Language_Support

## Use of the CCW API

The CCW API can be used store new clubs and to retrieve club data. This theme includes examples of each to get you started, both examples utilise the `CCW_API` class located in `inc/ccw-api.php`.

The full API documentation is available here: http://docs.codeclubworldapiv2.apiary.io/

Documentation on testing the API with a mock server is here: https://github.com/CodeClubInternational/cci-community-wordpress-theme/wiki/Club-API-&-Testing

### Club Creation Form

An example template for outputting a form which allows visitors to register their clubs via the Code Club World API is located in `template-parts/form-register-club.php`. It is completely self-contained to keep things as simple as possible. To use it:

* First, ensure that _all_ of the configuration values in `inc/country-config.php` are set (as part of this you'll need to create 'Terms & Conditions' and 'Registration Success' pages in WordPress so that you can supply paths to each). If you have any questions regarding the values in the config file, such as the API bearer tokens, please contact the CCW team.
* Include the form in one of your page templates using: `<?php get_template_part( 'template-parts/form', 'register-club' ); ?>`
* You're all set! The form will appear on the page and submissions to the form will be viewable in your CCW API admin account: https://api.codeclubworld.org/admin/clubs

**Note**: If using a child theme (see above), the `inc/country-config.php` file in the parent theme will need to be re-created within the child theme's directory, it can then be modified there. However, it won't automatically be included by `functions.php`  now that it exists in the child theme, so within your child theme's `functions.php` add the following:

```
/**
 * Country-specific config.
 */
require get_stylesheet_directory() . '/inc/country-config.php';
```

(Note the use of `get_stylesheet_directory()` rather than `get_template_directory()`, this is required in order to return the child theme directory instead of the parent theme directory. For more info see: https://codex.wordpress.org/Child_Themes#Referencing_.2F_Including_Files_in_Your_Child_Theme)

The constants defined in your child theme's `/inc/country-config.php` are now available and will be used by `template-parts/form-register-club.php` in the parent theme.

### Retrieval of All Clubs

Assuming the values in `inc/country-config.php` have been correctly set (see above), it's possible to to retrieve club data (from your country / community) very simply within any template:

```
<?php
$ccw_api = new CCW_API();
$response = $ccw_api->getClubs();
$clubs = $response['body'];
?>
```

The `$clubs` variable will contain an array of the first 50 clubs (to override this see below) which can then be used to populate a map / club listing view etc.

By default only active clubs are returned but it's possible to pass a `state` argument (set to `pending`, `active`, `suspended` or `deleted`) to override. Clubs are also paginated and return the first 50 records by default, this can be overriden by setting the `per_page` and `page` values. In summary: `getClubs( $state, $per_page, $page )`

For example:

```
// get only pending clubs, 25 per page and page #2
$ccw_api = new CCW_API();
$response = $ccw_api->getClubs( 'pending', 25, 2 );
```

#### Pagination

To aid the navigation through paginated resources & the generation of pagination links, a response such as that generated by the request `GET https://api.codeclubworld.org/clubs?in_country=XY&per_page=5&page=1` contains a `Link` header, eg:

```
Link: <https://api.codeclubworld.org/clubs?in_country=XY&per_page=5&page=1>; rel="first", <https://api.codeclubworld.org/clubs?in_country=XY&per_page=5&page=7>; rel="last", <https://api.codeclubworld.org/clubs?in_country=XY&per_page=5&page=2>; rel="next"
```

This can be parsed using:
```
<?php
$ccw_api = new CCW_API();
$response = $ccw_api->getClubs( 'active', 5, 1 );
$links = http_rels( $response['headers']['link'] );
?>
```

resulting in `$links` containing:
```
Array
(
    [first] => Array
        (
            [0] => https://api.codeclubworld.org/clubs?in_country=XY&page=1&per_page=5
        )

    [last] => Array
        (
            [0] => https://api.codeclubworld.org/clubs?in_country=XY&page=7&per_page=5
        )

    [next] => Array
        (
            [0] => https://api.codeclubworld.org/clubs?in_country=XY&page=2&per_page=5
        )

)
```

which can then be used to generate pagination links.

### Retrieval of a Single Club

To retrieve a single club by its ID (in this case, `1`) simply use:

```
<?php
$ccw_api = new CCW_API();
$response = $ccw_api->getClub(1);
$club = $response['body'];
?>
```

(bear in mind that you'll need to supply an ID for a club that belongs to your country / community!)

### Club Retrieval - Error Checking / Handling

Finally, to improve on the club retrieval examples, some error checking / handling would be useful:

```
<?php
$ccw_api = new CCW_API();
$response = $ccw_api->getClubs();

if ( !is_wp_error( $response ) ) {
    // The request went through successfully, check the response code against
    // what we're expecting
    if ( 200 == wp_remote_retrieve_response_code( $response ) ) {
        // Do something with the response
        $clubs = wp_remote_retrieve_body( $response );
        $headers = wp_remote_retrieve_headers( $response );
    } else {
        // The response code was not what we were expecting, record the message
        $error_message = wp_remote_retrieve_response_message( $response );
    }
} else {
    // There was an error making the request
    $error_message = $response->get_error_message();
}
?>
```

## Contributing

Issues and pull requests are welcomed / encouraged!

When submitting PRs, please run PHP CodeSniffer locally to alert of code standard issues:
```
php phpcs.phar --standard=ruleset.xml ./
```

To automatically _fix_ code standard issues, run:
```
php phpcbf.phar --standard=ruleset.xml ./
```

Full documentation is available here: https://github.com/squizlabs/PHP_CodeSniffer

See WordPress' PHP coding standards here: https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/

Please also refer to the [contributor license agreement](CONTRIBUTING.txt)

## Legal Stuff

Copyright (c) 2017 Raspberry Pi Foundation, UK Registered Charity 1129409

- [License](LICENSE.txt)
- [Contributing](CONTRIBUTING.txt)
