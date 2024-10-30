=== Chameleon Pure CSS Accordion ===
Contributors: Alterbid
Donate link: https://alterbid.com
Tags: Accordion, accordions, accordion plugin, accordion plugin, accordions plugin wordpress, accordions shortcode, accordion shortcode, accordions without scripts, accordion without scripts, accordion without javascript, accordion withouth jquery, css only accordion, pure css accordion, alterbid, accordions Widget, accordion Widget, hidden, hide, css accordion, css3, wordpress accordion, widget, shortcode, responsive, plugin, wordpress accordion plugin, chameleon, chameleon accordion, chameleon css accordion, chameleon pure css accordion  
Requires at least: 4.0
Requires PHP: 5.6
Tested up to: 4.9.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

It is easy accordion, shows posts anywhere via shortcodes, inherits the theme style and theme colors and does not divert the attention away from the information on the site.


== Description ==

Chameleon Pure CSS Accordion changes its colors to match the theme colors of your site and does not divert the attention away from the information that you want visitors to see on your site. This is a highly customizable accordion builder for wordpress. You can easy sort your accordion position using shortcodes, set height of items, title tag, limit of items in your accordion.

== Check Demos ==

* [Chameleon Pure CSS Accordion - Live Demo](https://alterbid.com/chameleon-pure-css-accordion-for-free/)
* [Read more about Chameleon Pure CSS Accordion Settings](https://alterbid.com/wp-content/uploads/2017/12/Chameleon_Pure_CSS_Accordion_Settings.pdf)
* [GitHub project](https://github.com/alterbid/chameleon-pure-css-accordion)

== Features Of Plugin ==

* Responsive Design 
* Limitless accordion anywhere in the theme
* Use via shortcodes
* Widget option available
* The accordion inherits the theme style, disguises itself as your theme colors.
* Highly customized for User Experience
* The accordion show the posts from the taxonomies you set in the shortcode

== Accordion Shortcode ==

	[chameleon_accordion item="1" id="x, y, z"]

Here "1" is your accordion shortcode number. You can add unlimited accordions and use any number of shortcode.
	
	example: [chameleon_accordion item="1" id="1"]

Accordion shows you all uncategorized posts ( or all terms id="1", or term_taxonomy_id = "1" )
Create a few posts in the category that will be displayed in your accordion. 
The accordion does not show the item if the item's id is the same as the id of the current page. So on the home page the accordion does not show the item with post_id = 1 "Hello World!"
We assume that there is no need to show the item in the accordion if the user has already opened  the page of this item.

== ACCORDION SETTINGS ==

1. Add ANY TAXONOMIES. You can use any taxonomies ids: 

	`[chameleon_accordion item="1" id="1, 2, 3"]`
   
   You can use any categories, tags or woocommerce categories via ids of column "term_id" from table "wp_terms" of your wordpress MySQL database,
   OR use url-reference of the category in the backend admin panel 
   
	`wp-admin/term.php?taxonomy=category&tag_ID=1`

  [See Accordion Settings](https://alterbid.com/wp-content/uploads/2017/12/Chameleon_Pure_CSS_Accordion_Settings.pdf)

2. Create ANY NUMBER of ACCORDIONS:

   Set number of your accordion. For example: item='1' ...
   
	`[chameleon_accordion item="1" id="1, 2, 3"]`

   Accordion does not work without №(number) of accordion ( for example: item="1" ) and without id  of taxonomy( for example: id="1, 2, 3" )
   The style file will not load if the accordion does not have any posts(items).
   For example: write shortcode
   
	`[chameleon_accordion item="1" id="1"]`
	
   to place accordion with Uncategorized posts Wordpress where you want
   
3. **title="..."**

	Add the TITLE of the ACCORDION.

	`[chameleon_accordion item="1" id="1" title="My Accordion" ]`
   
4. **tag="..."**
	
	Set the POSTS' TITLE TAG - p, div, h1, h2, h3, h4 ...

	`[chameleon_accordion item="1" id="1, 2, 3" tag="h4" ]`

   ( default paragraph "p" )
   
5. **height="..."**

	Set the HEIGHT (px) of ALL POSTS in the accordion.
	
	`[chameleon_accordion item="1" id="1, 2, 3" height="100" ]`
	
    ( default = 45 px )
	If the height of the item is less than 215px, when you hover the mouse over the item it opens to the height = your_item_height + 150px, if the height is more than 215px, the item opens to its maximum height.

6. **limit="..."**

	LIMIT the number of POSTS in the accordion, using limit = "5".
	
	`[chameleon_accordion item="1" id="1" limit="5"]`

	Items can be **permanent** or temporary. Remove only temporary items from the accordion using the LIMIT function.
	Articles that do **not need to be deleted** using the LIMIT function **must contain a shortcode** with the accordion number in which these posts are to be kept permanently:
	
	`[chameleon_kit item="1" ]`

	If the post contains the shortcode [chameleon_kit item = "1"], this post will not be deleted using the LIMIT function and is a permanent post.

	**Temporary posts** are posts that do **not contain shortcodes [chameleon_kit item = "1"]**.
	
	Among the temporary posts, if your limit allows, there remain posts in which the last ones were modified. The oldest posts are **removed from the accordion**.

== ACCORDION ITEMs' SETTINGS ==

	Add	

	`[chameleon_kit item="..." ]` 

   **to the item's text** to set up HEIGHT or ORDER of this item.

1. `[chameleon_kit item="..." height="..." ]`

	Set HEIGHT (px) of any ITEM in the accordion.

	Add

	`[chameleon_kit item="1" height="600" ]` 

   to the post(item) text.

2. `[chameleon_kit item="..." order="..."]`

	Set ORDER of ITEMs.
	All items are ordered by last modified in the item, but you can change the order of the items by specifying the order of the item in the text of this item; 
	order="last" if the item should be the last in the accordion, or order="1",if the item must be the top one in the accordion:
	
	`[chameleon_kit item="1" order="1"]` … 
	`[chameleon_kit item="1" order="last"]`

3. Use **DRAFT** to create item **without link to the post**. If post has "post_status" "draft" in your accordion and has shortcode
	for example: 

	`[chameleon_kit item="1"]`

   then the post does not have the link to the post and the link "read more" to the post.
   
	To DELETE DRAFT POST from accordion you have delete shortcode [chameleon_kit item="1"] from the text of the post.

== Unlimited Shortcode == 

Here you can create unlimited accordion group with unlimited shortcodes. So using shortcodes you can display your accordion on multiple page and post.

== Accordion Widget == 

There a widget option is integrated with this plugin, you will need just add shortcode [chameleon_accordion item="..." id="..."] in your widget area to display your accordion.


= It's works With Your Theme =

We have tested on with multiple popular themes and work on every themes. So design is very clean and works with your theme as well.

== Installation ==

1. Upload the entire `chameleon-pure-css-accordion` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add shortcode [chameleon_accordion item="1" id="1"] where you want to place the accordion ( ...for example: from Uncategorized posts or another category id (taxonomy id))

== Frequently Asked Questions ==

Please use WordPress support forum to ask any query regarding any issue.

== Screenshots ==
	
	01. Accordion inherits colors of your Theme and does not divert the attention away from the information on the site. >>>
	02. It "disguises" itself as your Theme. >>>
	03. It "disguises" itself as your Theme. >>> Add shortcode anywhere.
	04. **Add shortcode anywhere**. >>> Get taxonomy id from backend admin panel.
	05. **Get taxonomy id from backend admin panel**. >>> Get term_id from Database.
	06. **Get term_id from Database**. >>> Use a few term_id  in the shortcode.
	07. **Use a few term_id  in the shortcode**. >>> Create special category for the accordion.
	08. **Create special category for the accordion**. >>> Use categories of the tags.
	09. **Use categories of the tags**. >>> Create a few items in the category.
	10. **Create a few items in the category**. >>> Add the title of the accordion.
	11. **Add the title of the accordion**. >>> Set up tag for all item titles.
	12. **Set up tag for all item titles**. >>> Set up height of all items.
	13. **Set up height of all items**. >>> Set up item height.
	14. **Set up item height**. >>> Set up the order for the items.
	15. **Set up the order for the items**. >>> Set up limit of the items.
	16. **Set up limit of the items**. >>> Use status DRAFT to delete the link to the post.
	
	
== Upgrade Notice ==

= 1.0 =
* Initial release.

== Changelog ==

= 1.0 =
* First release.
