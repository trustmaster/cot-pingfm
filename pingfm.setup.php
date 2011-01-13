<?php
/* ====================
Copyright (c) 2008-2009, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.

[BEGIN_SED_EXTPLUGIN]
Code=pingfm
Name=Ping.fm
Description=Ping all your blogs
Version=1.0.1
Date=2009-jan-06
Author=Trustmaster
Copyright=
Notes=
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
devkey=01:string::dd87013480ccf7338416d5d216b695da:Plugin developer key (bundled)
appkey=02:string:::Your ping.fm Application Key
limit=03:string::25:Number of latest posts displayed
order=04:select:ASC,DESC:DESC:Display order
delim=05:string::, :Services list delimiter
timeout=06:string::30:Cache timeout in minutes, a positive number
username=07:string:::Username to prepend in status messages
[END_SED_EXTPLUGIN_CONFIG]
==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }
?>