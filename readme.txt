This plugin enables you to post and display messages from over 30 popular social network sites by utilizing Ping.fm service.

Features:
- Ping all your blogs from your Seditio site.
- Over 30 social networks supported, see the complete list.
- Select services to post to.
- Display recent posts from all your social networks and blogs on index.

Installation:
1. Register and set up your Ping.fm account (http://ping.fm)
2. Get your Application key from http://ping.fm/key/
3. Install the plugin.
4. Change your plugin configuration in Administration => Configuration => pingfm
5. Add {PLUGIN_PINGFM} to your index.tpl
6. Customize plugins/pingfm/tpl/pingfm.tpl for your needs.

Customization:
There are 3 types of blocks in pingfm.tpl:
- PINGFM_STATUS for status and mini-blogs
- PINGFM_BLOG for blog posts
- PINGFM_POST for any of status/blogs/microblogs
Tags available are:
{PINGFM_POST_METHOD} - Status/Blog/Mini-Blog
{PINGFM_POST_DATE}
{PINGFM_POST_SERVICES_NAMES} - services as text
{PINGFM_POST_SERVICES_ICONS} - services as icons
{PINGFM_POST_SERVICES_FULL} - services as icons and text
{PINGFM_POST_TITLE} - for blogs only
{PINGFM_POST_BODY}

Supported networks and tools:
- aim
- bebo
- blogger
- brightkite
- custom
- delicious
- diigo
- facebook
- friendfeed
- friendster
- google
- gtalk
- hi5
- identi.ca
- iphone
- jaiku
- koornk
- kwippy
- linkedin
- livejournal
- mashable
- multiply
- myspace
- ping
- plaxo
- plurk
- pownce
- rejaw
- sms
- tumblr
- twitter
- wlm
- wordpress
- xanga
- yahoo
- yahoo360
- yammer
- youare
