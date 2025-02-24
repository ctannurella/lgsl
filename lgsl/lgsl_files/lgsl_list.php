<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                      [ LIVE GAME SERVER LIST ] [ � RICHARD PERRY FROM GREYCUBE.COM ]                       |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  require "lgsl_class.php";

  $server_list = lgsl_query_group();
  $server_list = lgsl_sort_servers($server_list);

//------------------------------------------------------------------------------------------------------------+

  $output .= "
	<table id='server_list_table'>
		<tr id='server_list_table_top'>
			<th>{$lgsl_config['text']['sts']}</th>
			<th>{$lgsl_config['text']['adr']}</th>
			<th>{$lgsl_config['text']['tns']}</th>
			<th>{$lgsl_config['text']['map']}</th>
			<th>{$lgsl_config['text']['plr']}</th>
			<th>{$lgsl_config['text']['vsd']}</th>
		</tr>";

	foreach ($server_list as $server)
	{
		$misc   = lgsl_server_misc($server);
		$server = lgsl_server_html($server);

		$output .= "
		<tr class='server_{$misc['text_status']}'>

			<td class='status_cell'>
				<span title='{$lgsl_config['text'][$misc['text_status']]}' class='status_icon_{$misc['text_status']}'></span>
				<img alt='{$misc['name_filtered']}' src='{$misc['icon_game']}' title='{$misc['text_type_game']}' class='game_icon' />
			</td>

			<td title='{$lgsl_config['text']['slk']}' class='connectlink_cell'>
				<a href='{$misc['software_link']}'>
					{$server['b']['ip']}:{$server['b']['c_port']}
				</a>
			</td>

			<td title='{$server['s']['name']}' class='servername_cell'>
				<div>
					{$misc['name_filtered']}
				</div>
			</td>

			<td class='map_cell'>
				{$server['s']['map']}
			</td>

			<td class='players_cell'>
				{$server['s']['players']} / <span class='maxplayers'>{$server['s']['playersmax']}</span>
			</td>

			<td class='details_cell'>";

			if ($lgsl_config['locations'])
			{
				$output .= "
				<a href='".lgsl_location_link($server['o']['location'])."'>
					<img alt='' src='{$misc['icon_location']}' title='{$misc['text_location']}' class='contry_icon' />
				</a>";
			}

			$output .= "
				<a href='".lgsl_link($server['o']['id'])."' class='details_icon' title='{$lgsl_config['text']['vsd']}'></a>
			</td>

		</tr>";
	}

	$output .= "
	</table>";

//------------------------------------------------------------------------------------------------------------+

  if ($lgsl_config['list']['totals'])
  {
    $total = lgsl_group_totals($server_list);

    $output .= "
    <div id='totals'>
          <div class='inline'> {$lgsl_config['text']['tns']} {$total['servers']}    </div>
          <div class='inline'> {$lgsl_config['text']['tnp']} {$total['players']}    </div>
          <div class='inline'> {$lgsl_config['text']['tmp']} {$total['playersmax']} </div>
    </div>";
  }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//------ PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT GREYCUBE.COM IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $output .= "<div style='text-align:center; font-family:tahoma; font-size:9px'><br /><br /><br /><a href='http://www.greycube.com' style='text-decoration:none'>".lgsl_version()."</a><br /></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
