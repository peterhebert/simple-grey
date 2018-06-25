Simple Grey
===========

A responsive WordPress theme with a simple grey color palette. Clean and simple, this theme is optimized for legibility. It is well suited to blogs and portfolio sites.

## Theme Features
This theme has support for all of the built-in WordPress [Theme Features](https://codex.wordpress.org/Theme_Features).

## Customization
You can use the Theme Customizer for easy modification of the following theme settings:

#### Site Branding
In addition to the Site Title and Description, you can:
- Add a logo to be displayed in the Header
- Apply styles to the logo: slightly rounded corners, or a circle effect.
- Upload a Site Icon to be used as a browser favicon and app icon on mobile operating systems.

#### Header
This section allows you to customize the appearance of the Header
- change the colors used in the Header:
  - background color
  - text color
  - link color and link hover color
- upload an image to be used as the background for the Header
- add a drop shadow to elements in the Header

#### Background Image
This section allows you to upload an image to be used as the background for the main content area.

#### Menus
This theme includes one Primary Navigation menu area, which is displayed right under the page Header.

#### Navigation
You can set the Primary Navigation menu to any of the following styles:
- **Flat** - this will present all the links inline regardless of the hierarchy of the menu.
- **Hierarchical** - this style presents the menus as nested lists
- **Drop Down** - this style displays the menu in a fully accessible nested drop-down style.

#### Widget Areas
This theme defines the following widget areas:
- **Secondary** - this is the main widget area, appears as a sidebar.
- **Featured** - This is an additional widget area used by the Feature Page template, used for featured content widgets, usually presented full width.
- **Footer** - a responsive widget area in the footer that responsively switches between 1, 2 and 3 columns depending upon available space.

#### Footer
The footer has two text fields (Top and Bottom), for displaying credits, copyright info and the like in the footer.
- **Footer Top Text** is displayed at the top of the footer, above the Footer Widgets.
- **Footer Bottom Text** is displayed under the Footer Widgets.
- You can also choose whether or not to Display the WordPress and Theme credits at the bottom of the footer.

### Web fonts
This theme uses the [Open Sans](https://fonts.google.com/specimen/Open+Sans?selection.family=Open+Sans) web font via Google Fonts. In addition, it includes the following icon fonts:
- [Font Awesome](http://fontawesome.io/)
- [More Vectors](https://github.com/peterhebert/More-Vectors-Icon-Font)

### Feature Page Template
This theme includes a *Feature Page* template, which can be used for a front page, or a landing page. It contains an additional widget area that allows you to have full-width widgets.

## Complementary Plugins
The following plugins are quite useful in conjunction with this theme:
- [Widget CSS Classes](https://en-ca.wordpress.org/plugins/widget-css-classes/) - allows you to apply CSS classes to any widget. For example:
    - by applying the class 'icons' to widgets in the footer, the theme will allow you to style social media icons to match the footer (dark grey instead of the blue link color). See this in action at [my personal site](https://peterhebert.com/)
    - by applying the class 'columns' to widgets in the Featured widget area, you can have your widgets be in columns, instead of full width.
- [Display Widgets](https://wordpress.org/plugins/display-widgets/) - allows you to choose which posts or pages your widgets are displayed on.
- [Custom Query Shortcode](https://wordpress.org/plugins/custom-query-shortcode/) - provides a shortcode for using custom queries in your page or post. Simple Grey includes support for using shortcodes within Widgets, so you could use this to generate complex layouts or featured content areas, slideshows, etc.


## Credits
The following tools and code libraries have ben used in the development of Simple Grey:

- [Underscores](http://underscores.me/) (_s), by [Automattic](http://automattic.com/) provides the base functionality of the theme, and is a solid foundation for any theme.
- [normalize.css](http://necolas.github.com/normalize.css/) by Nicolas Gallagher and Jonathan Neal is used for css normalization.
- [Fluid Baseline Grid Redux](https://github.com/peterhebert/Fluid-Baseline-Grid-Redux) is the framework for grid generation and base styles
- [node.js](https://nodejs.org/en/) and [Gulp](http://gulpjs.com/) are used to compile LESS into CSS, to create POT file for translation, and to build the theme.

## Development, Issues and Contributions
All development of this theme is done on [GitHub](https://github.com/peterhebert/simple-grey). Please file any issues with the theme against the GitHub repository. Contributions are welcome, feel free to fork the project and make pull requests.

## More information
More information about this theme is available on the [Rex Rana](https://rexrana.ca/code/simple-grey-wordpress-theme) website.

## Changelog

1.5.2
- Added Customizer settings for Header Text Color, Header Link Color and Header Link Hover Color
- Grouped all header-related Customizer settings into "Header" section

1.5.1
- fixed [bug](https://github.com/peterhebert/simple-grey/issues/5) where comments and admin bar would not display if only one post exists
- Renamed page template single-column-narrow.php to page-single-column-narrow.php, so that it is not confused by WordPress as a single post template.

1.5.0
- Added new page template "Single Column Narrow", which uses a single column layout with the secondary sidebar displayed below instead of to the right. The maximum content with would be 60em for this template, designed for optimum line length. This was previously the behaviour of the default page template. The default page template now uses the same behaviour as the posts and archive pages, of displaying the secondary sidebar to the right if active.
- Added comments to all page templates. Enable the "Discussion" checkbox under Screen Options to enable the discussion settings on Pages. Then you can enable comments on a page if you so choose.
- cleaned up editor styles
- fixed [bug](https://github.com/peterhebert/simple-grey/issues/3) where tinymce editor would keep growing while typing in editor

1.4.4
- added fix to not display secondary sidebar if not active - [issue](https://github.com/peterhebert/simple-grey/issues/1)
