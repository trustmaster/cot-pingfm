<?php
/* ====================
Copyright (c) 2008-2009, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.

[BEGIN_SED_EXTPLUGIN]
Code=pingfm
Part=admin
File=pingfm.admin
Hooks=tools
Tags=
Order=
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once $cfg['plugins_dir'] . '/pingfm/inc/PHPingFM.php';
include_once sed_langfile('pingfm');

$plugin_body = '<h4>Ping.fm '.$L['Poster'].'</h4>';

// Try to authorize first
$pfm = new PHPingFM($cfg['plugin']['pingfm']['devkey'], $cfg['plugin']['pingfm']['appkey']);
if(!$pfm->validate() && !$pfm->validate()) // for some reason first time it often fails
{
	$plugin_body .= '<div class="error">'.$L['Invalid_keys'].'</div>';
}
else
{

	// Add a new post if submitted
	$method = sed_import('method', 'P', 'ALP');
	$body = sed_import('body', 'P', 'TXT');
	$title = sed_import('title', 'P', 'TXT');
	$services = sed_import('services', 'P', 'ARR');
	if(!empty($method) && !empty($body))
	{
		if($pfm->post($method, $body, $title, $services))
		{
			$plugin_body .= '<div class="error">'.$L['Post_submitted'].'</div>';
		}
		else
		{
			$plugin_body .= '<div class="error">'.$L['Post_error'].'</div>';
		}
	}

	// Create "new post" form
	$meth = '<option value="status">'.$L['Status'].'</option><option value="miniblog">'.$L['Miniblog'].'</option><option value="blog">'.$L['Blog'].'</option>';
	$serv = '';
	$srv = $pfm->services();
	if(!empty($srv) && count($srv) > 0)
	{
		foreach($srv as $key => $val)
		{
			$serv .= '<option value="'.$key.'">'.$val['name'].'</option>';
		}
	}
	$url = sed_url('admin', 'm=tools&p=pingfm');
	$plugin_body .= <<<HTM
	<form action="$url" method="post">
	<table>
	<tr>
	<td>{$L['Type']}:</td>
	<td><select name="method">$meth</select></td>
	</tr>
	<tr>
	<td>{$L['Title']} <em>({$L['Blog_only']})</em>:</td>
	<td><input type="text" name="title" /></td>
	</tr>
	<tr>
	<td>{$L['Text']}:</td>
	<td><textarea name="body" rows="5" cols="30"></textarea></td>
	</tr>
	<tr>
	<td>{$L['Services']}:</td>
	<td><select name="services[]" multiple="multiple" size="4">$serv</select></td>
	</tr>
	<tr>
	<td colspan="2"><input type="submit" value="{$L['Add']}" /></td>
	</tr>
</table>
</form>
HTM;
}
?>