=== LH Image Renamer ===
Contributors: shawfactor
Tags: file rename, upload, renaming, file, rename, image
Requires at least: 4.0
Tested up to: 6.0
Donate link: https://lhero.org/portfolio/lh-image-renamer/
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Gives attached image uploads a intuitive file name.

== Description ==

When you take photos with your digital camera and then upload them as attachments to a post or page their file name is not altered. This is not inintuitve as then you end upo with 100s of image files with names live IMG_1432.jpg

This plugin fixes that problem by appending a file safe string to the front the file name which is based on the post, page, or cpts slug or post title.

e.g. my-post-title-my-image-name.jpg

This will only accurr for images uploaded as attachments.

**Like this plugin? Please consider [leaving a 5-star review](https://wordpress.org/support/view/plugin-reviews/lh-image-renamer/).**

**Love this plugin or want to help the LocalHero Project? Please consider [making a donation](https://lhero.org/portfolio/lh-image-renamer/).**

== Frequently Asked Questions ==
= What are the available options provided by this plugin? =

There are no options, this is WordPress, so decisions not options

= Im a developer, can I create a custom rule?

Yes. It's easy.

You can filter the name used by using the filter built into this plugin:

add_filter( 'lh_image_renamer_return_name_filter', function($return, $file_object, $post_object, $file_name, $file_ext){

//do your thing

return $return;

}, 20 );

= What is something does not work?  =

LH Image Renamer, and all [https://lhero.org](LocalHero) plugins are made to WordPress standards. Therefore they should work with all well coded plugins and themes. However not all plugins and themes are well coded (and this includes many popular ones). 

If something does not work properly, firstly deactivate ALL other plugins and switch to one of the themes that come with core, e.g. twentyfirteen, twentysixteen etc.

If the problem persists please leave a post in the support forum: [https://wordpress.org/support/plugin/lh-image-renamer/](https://wordpress.org/support/plugin/lh-image-renamer/). I look there regularly and resolve most queries.

= What if I need a feature that is not in the plugin?  =

Please contact me for custom work and enhancements here: [https://shawfactor.com/contact/](https://shawfactor.com/contact/)

== Installation ==

1. Upload the entire 'lh-image-renamer' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Changelog ==

**1.00 July 05, 2017**
* Initial Release

**1.01 July 16, 2018**
* Singleton pattern