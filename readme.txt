=== Sub Categories Widget ===
Contributors: BrokenCrust
Tags: widget, category, sub-category, list
Requires at least: 2.9
Tested up to: 4.1
Stable tag: 1.4.1
License: GPLv2 or later

This Widget lists the sub-categories as links or in a drop-down menu for a given category.

== Description ==

Sometimes when you divide up your WordPress content into categories it all ends up in sub-categories of one or two main categories that don't have any content themselves.

With the widget you can add a list of sub-categories even if the parent doesn't have posts.

You can display and filter sub-categories in various ways:

* Use the parent category as the widget title
* Show post counts in bracket next to the name
* Hide empty sub-categories
* Add a link to the parent category to the widget title
* Show the full sub-category tree so it include sub-sub categories and so on as well
* Display the list as dropdown rather than as links
* Use the first category of the current post as the parent
* Exclude one or more sub-categories from the list

== Installation ==

Installing is pretty easy takes only a minute or two.

1. Upload `sub-category-widget` directory to your `/wp-content/plugins/` directory.
1. Activate the plugin through the Plugins screen in WordPress.
1. On the Widgets sub-menu of Appearance you will find a new widget type called Sub Category.
1. Add one or more of these to your themes widget display areas.
1. For each widget you add, decide what and how you'd like it to display.
1. Save your settings.

== Changelog ==

= 1.4.1 =
* Fixed missing parent category notice on pages when using irst category of the post option

= 1.4 =
* Added an option to use the first category of the post as the parent
* Improved and updated sanitation and validation

= 1.3.01 =
* Updated the dropdown to be in name order (to match the list)

= 1.3 =
* Added option to show as dropdown list
* Tidy of widget options area

= 1.2 =
* Added ability to exclude categories (with a comma delimited list)
* Added option to show the entire sub-category tree rather than just one level

= 1.1 =
* Highlights the current category if on a category archive page (use .current-cat to style)

= 1.0 =
* First Production Release

= 0.1 =
* Initial Release
