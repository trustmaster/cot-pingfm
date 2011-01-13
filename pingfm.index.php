<?php
/* ====================
Copyright (c) 2008-2009, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.

[BEGIN_SED_EXTPLUGIN]
Code=pingfm
Part=index
File=pingfm.index
Hooks=index.tags
Tags=index.tpl:{PLUGIN_PINGFM}
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once $cfg['plugins_dir'] . '/pingfm/inc/PHPingFM.php';
include_once sed_langfile('pingfm');

if(!$pingfm)
{
	$t1 = new XTemplate(sed_skinfile('pingfm'));
	$pfm = new PHPingFM($cfg['plugin']['pingfm']['devkey'], $cfg['plugin']['pingfm']['appkey']);
	$pfm_posts = $pfm->latest($cfg['plugin']['pingfm']['limit'], $cfg['plugin']['pingfm']['order']);
	if(is_array($pfm_posts))
	{
		foreach($pfm_posts as $post)
		{
			$srv_names = array();
			$srv_icons = array();
			$srv_full = array();
			if(is_array($post['services']))
			{
				foreach($post['services'] as $key => $val)
				{
					$srv_names[] = $val;
					$srv_icons[] = '<img src="'.$cfg['plugins_dir'].'/pingfm/img/'.$key.'.png" alt="" />';
					$srv_full[] = '<img src="'.$cfg['plugins_dir'].'/pingfm/img/'.$key.'.png" alt="" /> '.$val;
				}
			}
			$t1->assign(array(
				'PINGFM_POST_METHOD' => strtoupper($post['method'][0]) . substr($post['method'], 1, -1),
				'PINGFM_POST_DATE' => @date($cfg['dateformat'], $post['date']['unix'] + $usr['timezone'] * 3600)." ".$usr['timetext'],
				'PINGFM_POST_SERVICES_NAMES' => implode($cfg['plugin']['pingfm']['delim'], $srv_names),
				'PINGFM_POST_SERVICES_ICONS' => implode($cfg['plugin']['pingfm']['delim'], $srv_icons),
				'PINGFM_POST_SERVICES_FULL' => implode($cfg['plugin']['pingfm']['delim'], $srv_full),
				'PINGFM_POST_TITLE' => $post['title'],
				'PINGFM_POST_BODY' => empty($cfg['plugin']['pingfm']['username']) ? $post['body'] : $cfg['plugin']['pingfm']['username'] . ' ' . $post['body']
			));
			$t1->parse('PINGFM.PINGFM_POST');
			$block = $post['method'] == 'blog' ? 'BLOG' : 'STATUS';
			$t1->parse('PINGFM.PINGFM_' . $block);
		}
		$t1->parse('PINGFM');
		$pingfm = $t1->text('PINGFM');
		sed_cache_store('pingfm', $pingfm, $cfg['plugin']['pingfm']['timeout'] * 60);
	}
}

$pfm_admin = $usr['isadmin'] ? '<br /><a href="'.sed_url('admin', 'm=tools&p=pingfm').'">'.$L['PingIt'].'</a>' : '';

$t->assign('PLUGIN_PINGFM', $pingfm . $pfm_admin);
?>