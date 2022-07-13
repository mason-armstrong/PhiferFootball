=== Magic Post Thumbnail ===
Plugin Name:       Magic Post Thumbnail
Version:           3.3.12
Tags:              automatic, thumbnail, featured, image, generate, google image, google api, flickr, pixabay, aggregation, autoblog, autoblogging, autopost, scraping, image bank, magic, youtube, shutterstock, unsplash, cron
Donate link:       https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=contact%40magic-post-thumbnail.com&item_name=Donation+for+Magic+Post+Thumbnail&currency_code=EUR&source=url
Contributors:      Mcurly
Author URI:        https://magic-post-thumbnail.com/
Author:            Magic Post Thumbnail
Requires at least: 4.0
Tested up to:      6.0
Stable tag:        3.3.12
Requires PHP:      6.0


Automatically generate thumbnails & images for your posts. Magic Post Thumbnail use Google Image/Flickr/Pixabay to create an Automatic Featured Image.

== Description ==
Automatically **generate thumbnails & images for your posts** !

Retrieve images from **Google Images**, **Flickr** or **Pixabay** thanks to API, based on your post title, **text analysis** and much more. The plugin add picture as your **featured thumbnail** or **inside the post** when you publish the post.
The plugin allow you to configure some settings for your automatics images : **Image bank**, language search, posts types chosen, image type, free-to-use or not, image size and much more.

**New feature** : **Images based** on **text analysis** !

**<a target="_blank" href="https://magic-post-thumbnail.com/">Official Website</a>**

== What is included ? ==

= Magic Post Thumbnail for FREE =
[Support](https://wordpress.org/support/plugin/magic-post-thumbnail/)

<ul>
<li>Generate Thumbnail for one post</li>
<li><strong>Generate Thumbnails</strong> for <strong>Posts</strong>, Pages & <strong>Custom Post Types</strong></li>
<li>Image based on <strong>Titles</strong> or <strong>Text Analysis</strong></li>
<li>Images from <strong>Google Image</strong>, Google API, Pixabay or Flickr</li>
<li><strong>Mass Image Generation</strong> for chosen posts or chosen taxonomies</li>
<li>Comptability with WPeMatico, CyberSyn, Rss Post Importer, FeedWordPress, WP All Import and more!</li>
</ul>

= Magic Post Thumbnail PRO =
[Upgrade to PRO](https://magic-post-thumbnail.com/pricing/) | [Support](https://magic-post-thumbnail.com/contact-us/)

<ul>
<li>Customisable <strong>Crons</strong></li>
<li>Images from Youtube, ShutterStock, Getty Images or Unsplash</li>
<li>Image based on <strong>Tags</strong>, <strong>Categories</strong>, <strong>Custom Fields</strong></li>
<li>Image generated randomized</li>
<li>Restricted domains</li>
<li>Setup a proxy</li>
<li><strong>24h Support</strong></li>
</ul>

== Translations ==
* English
* French

== Todo list ==

Magic post thumbnail is improving progressively. Feel free to post on the forum or email to give your suggestion or warn about a bug.

* More translations (you can help)
* Improve integration with Gutemberg editor

== Screenshots ==
1. Magic Post Thumbnail : Bulk Generation
2. Magic post Thumbnail : Settings
3. Magic post Thumbnail : Image Banks
4. Magic post Thumbnail : Cron
5. Magic post Thumbnail : Generate featured images for post types
6. Magic post Thumbnail : Generate featured images for taxonomies

== Support the plugin ==
If you've found the plugin useful, please consider <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=contact%40magic-post-thumbnail.com&item_name=Donation+for+Magic+Post+Thumbnail&currency_code=EUR&source=url">making a donation</a>. Thank you for your support !


== Installation ==
1. Activate the plugin
2. Go to Settings > Magic Post Thumbnail
3. Configure your settings, which post type you want to enable it and the image bank.
4. Go into a post or create one, choose "Plugin enabled for this post" on the sidebar. Update/Create the post and your thumbnail is generated as featured image !
5. You can also **mass generate thumbnails** for posts. Go into the list of your posts, choose posts or taxonomy you want to get thumbnails, and into "Bulk Actions" choose "Generate featured images"

If you want to use the **Google Image API method** : From now on to use the Google Images API, **it's required** to provide your own Google Search engine ID and API Key. Follow these steps : 

* Go to the <a target="_blank" href="https://console.developers.google.com">Google API Console</a> > Credentials > Create credentials > API key, copy your new key into the plugin preferences ( Google API Key	field ). Then go to Library > Custom Search API > Enable.
* Go to <a target="_blank" href="https://cse.google.com/cse/all">Custom Search page</a>. Create a new search engine. Then edit the search engine and get the search engine ID. Copy/paste it into the plugin preferences ( Custom Search Engine ID field ).
* Enjoy !

The "How to do" for APIs activations is <a target="_blank" href="https://magic-post-thumbnail.com/how-to/">available here</a>.


== Frequently Asked Questions ==

= How to generate images ? =

There are several ways :
<ul>
<li>You can generate an image when you update a post.</li>
<li>You can mass generate thumbnails for posts. Go into the list of your posts, choose posts or taxonomy you want to get thumbnails, and into “Bulk Actions” choose “Generate featured images”</li>
<li>You can also automatically schedule generation with crons with the Pro version.</li>
</ul>

= Is it unlimited ? =

Yes you can generate image as much as you want.

= I have other pre-sale questions, can you help? =

Yes! You can ask us any question through our <a href="https://magic-post-thumbnail.com/contact-us/">support page</a>.


== Upgrade Notice == 

Upgrade your plugin to **<a target="_blank" href="https://magic-post-thumbnail.com/pricing/">Pro Version</a>** ! You will get much more options to configure, more image banks, and customisable crons.


== Changelog ==

= 3.3.12 =
* Fix Regex with Google Image Method 
* PRO : Fix bug with proxy and PHP 8.0
* Update Freemius

= 3.3.11 =
* Update Freemius

= 3.3.10 =
* Fix Wp All import : avoid images with double generation 
* Add do_action('mpt_after_create_thumb') after generation
* Add trim() to Google Image (API) for ID & Key

= 3.3.9 =
* Remove some errors "Post box not check"
* PRO : Fix with FIFU Compatibility

= 3.3.8 =
* Error with readme

= 3.3.7 =
* Security fix
* New Freemius version

= 3.3.6 =
* Fix Regex with Google Image Method 

= 3.3.5 =
* Fix with Google Image Method

= 3.3.4 =
* Fix with Google Image Method

= 3.3.3 =
* Fix problem with all banks except Google due to last update
* PRO : Add notice about proxies : Work only with HTTPS protocol

= 3.3.2 =
* Improved results: Remove more empty images that may appear 
* Freemius update
* PRO : Add "Blacklisted domains"
* PRO : Add Username & Password for proxy

= 3.3.1 =
* Fix errors with custom post types and excluded categories

= 3.3 =
* Improved results: Remove some empty images that may appear
* Link between media & post into the media library
* PRO : Add "Featured Image from URL" plugin compatibility

= 3.2.1 =
* Fix problem with WP All import and custom fields

= 3.2 =
* Add "Text_analyser" for "Based on" option
* Add logs

= 3.1.3 =
* Add Affiliation tab

= 3.1.2 =
* PRO : Fix bug with categories for image into posts

= 3.1.1 =
* Fix broken banks (all except Google Image)
* Fix "select all" input for free version
* Improve regex for Google Image
	
= 3.1 =
* Repair scraping for Google Image
* "Select all" input for some settings
* Parameters for js & css files for problems with browser cache
* PRO : Add proxy settings

= 3.0 =
* New Bulk generation design
* Work with resizers plugins
* More Google Image Sizes
* New setting : Image format
* Remove useless files
* Change image generation method : use admin-ajax now
* Fix error with "Restricted domains" textarea
* PRO : Fix problem with crons that don't fire
* PRO : Fix problem with crons, - pages images don't generate
* PRO : Better design in Crons settings (interval & Post date)
* PRO : New setting - Image generation into posts