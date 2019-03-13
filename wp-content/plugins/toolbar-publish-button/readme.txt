=== Toolbar Publish Button ===
Contributors: webbistro
Tags: ux, user experience, wp-admin, admin, publish, toolbar, save, button, update, post, page, settings, scrollbar, scrolling, admin bar, backend, admin menu, sticky menu
Requires at least: 4.6
Tested up to: 4.9.8
Stable tag: 1.6.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



Scroll less in WordPress admin area! A small UX improvement will keep Publish button within reach and retain the scrollbar position after saving.



== Description ==

Too often it turns out very inconvenient to scroll WordPress admin page back and forth in the quest for the big blue button to save latest changes.

Simple jQuery script of this plugin duplicates Update / Publish / Save Changes / Save Draft / Preview Changes button for posts, pages, custom posts, taxonomies, user profiles, and settings to the top WordPress admin bar, so that it stays on site while you are scrolling your admin page. The plugin options allow to keep the scrollbar position after saving.

The plugin is well-integrated with the Advanced Custom Fields, and capable to leave open ACF field groups after saving your edits.

The plugin does not affect any native WordPress functionality, it just redirects your click to the original button, and uses the current button text, of course, with the current language.


= Plugin options allow: =

* to keep the scrollbar position after saving for admin pages including code Editor and Plugins page after plugin activation / deactivation,
* to choose which buttons to show on the admin bar,
* to set a background color for its buttons to highlight them.


= Available Languages =

You can see the list of available translations and their progress on [wpUXsolutions.com](https://www.wpuxsolutions.com/l10n/projects/toolbar-publish-button). Many thanks to all involved!

Assistance with translating is highly appreciated! If you'd like to be a translation editor or to suggest translations for your language please feel free to contribute to translation. All changes made are included to every new release of the plugin.



== Installation ==

1. Upload plugin folder to the '/wp-content/plugins/' directory

2. Activate the plugin through the 'Plugins' menu in the WordPress admin

3. Change settings on Settings -> Toolbar Publish Button if you wish

4. Enjoy the clone of the Update / Publish button on the admin top toolbar when editing posts, pages and custom post types.



== Screenshots ==

1. Publish and Save Draft buttons for a post

2. Toolbar Publish Button Options Page

3. How can the Publish Button be helpful



== Changelog ==

= 1.6.2 =
*Release Date - August 29, 2018*

= Bugfixes =
* Conflict with ACF scripts fixed


&nbsp;
= 1.6.1 =
*Release Date - August 28, 2018*

= Improvements =
* Compatibility with the latest ACF versions ensured


&nbsp;
= 1.6 =
*Release Date - February 2, 2017*

= Improvements =
* "Save Draft" and "Preview" buttons are now optional
* Minor code improvements

= Bugfixes =
* Minor bugs fixed


&nbsp;
= 1.5.2 =
*Release Date - October 11, 2016*

= Improvements =
* Text domain changed to 'toolbar-publish-button'.
* Preview button added.
* Minor bugs fixed.


&nbsp;
= 1.5.1 =
*Release Date - October 10, 2016*

= Bugfixes =
* Plugin settings change on update fixed. Please upgrade from v.1.5 for correct work.


&nbsp;
= 1.5 =
*Release Date - October 10, 2016*

= Improvements =
* The PHP code is totally refactored, some unnecessary and obsolete code has been removed.
* 'Save Draft' is now changing for 'Save as Pending' and vise versa automatically.

= Compatibility =
* WordPress 4.6 compatibility ensured.
* ACF compatibility ensured.


&nbsp;
= 1.4.3 =
*Release Date - September 15, 2015*

= Improvements =
* The button script removed from unnecessary admin pages
* Unnecessary buttons removed from the admin bar for some pages



= 1.4.2 =
*Release Date - September 14, 2015*

= Bugfixes =
* Bugs of v1.4 fixed


&nbsp;
= 1.4.1 =
*Release Date - September 14, 2015*

= Improvements =
* Better color management for button's background


&nbsp;
= 1.4 =
*Release Date - September 14, 2015*

= New =
* Save Draft button added [Customer's Request](https://wordpress.org/support/topic/feature-request-add-a-save-draft-option)
* Button's Background option added [Customer's Request](https://wordpress.org/support/topic/brilliant-a-suggestion-on-how-to-make-it-a-hint-better)

= Languages =
* Serbian translation added
* Ukrainian translation added


&nbsp;
= 1.3 =
* Update: Wordpress 4.2.2 compatibility ensured.
* Bugfix: Small bugs from the [Support Forum](https://wordpress.org/support/plugin/toolbar-publish-button) fixed.

= 1.2.5 =
* Update: Compatibility with other admin menu plugins improved: [Support Request](http://wordpress.org/support/topic/plugin-conflict-30).
* Bugfix: Small javascript uploade bug fixed.

= 1.2.4 =
* Update: Minor scripts' improvements.

= 1.2.3 =
* Bugfix: Collapsed menu incorrect behavior fixed.

= 1.2.2 =
* Update: Sticky menu behavior improved, minor bugs fixed.
* Update: JS code is totally reconsidered for better performance.

= 1.2.1 =
* Bugfix: Sticky menu incorrect scrolling mechanism fixed.

= 1.2.0 =
* Update: Huge sticky admin menu behavior improvement: menu is scrollable only within its own height if it doesn't fit into browser window height. Just try it :)
* Update: Minor js code improvements.

= 1.1.7 =
* New:    "Remembers" scrollbar position for Jetpack custom CSS editor.
* Bugfix: Corrected mechanism of choosing a button for cloning.
* Bugfix: Native button can also "remember" scrollbar position from now.
* Update: Sticky main menu changes its behavior after browser window resize to match new dimensions.

= 1.1.6 =
* New:    Capability to remember a scrollbar position of the plugin list page after Activate/Deactivate button click added. It will work when Remember scrollbar position option is selected.
* Bugfix: Fixed menu CSS minor bug fixed.

= 1.1.5 =
* Bugfix: Script versions mechanism fixed. Please upgrade the plugin especially in case you can't see the changes from version 1.1.4

= 1.1.4 =
* Update: Main menu fixation mechanism improved. From now main menu won't be sticked if it doesn't fit into one screen automatically, no need to turn it off manually. Thanks MP6 for inspiration.

= 1.1.3 =
* New:    "Sticky main menu" option added.
* Bugfix: Minor text correction done.

= 1.1.2 =
* New:    The plugin admin texts localization mechanism implemented. (Note: Frontend doesn't need to be localized because it uses the current text (and language) of the button via javascript).
* Bugfix: Inaccurate scrollbar position calculation fixed.

= 1.1.1 =
* Update: Minor improvement of plugin upgrade process.

= 1.1.0 =
* New:    "Remember scrollbar position" option added.

= 1.0.4 =
* Update: Script moved to the footer for better site performance.

= 1.0.3 =
* Update: Minor improvements.

= 1.0.2 =
* New:    ACF plugin Option Page button support added.

= 1.0.1 =
* Bugfix: Minor bugs fixing.

= 1.0.0 =
* New:    Toolbar Publish Button initial release.
