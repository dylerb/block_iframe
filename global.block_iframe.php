<?php
/**
 * @Project NUKEVIET 4.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES., JSC. All rights reserved
 * @Createdate 3/9/2010 23:25
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_iframe_blocks' ) )
{

    function nv_block_config_iframe_blocks ( $module, $data_block, $lang_block )
    {
        $html .= '<tr>';
        $html .= '	<td>' . $lang_block['url'] . '</td>';
        $html .= '	<td><input type="text" name="config_url" size="50" value="' . $data_block['url'] . '"/></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '	<td>' . $lang_block['width'] . '</td>';
        $html .= '	<td><input type="text" name="config_width" size="5" value="' . $data_block['width'] . '"/>&nbsp;%</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '	<td>' . $lang_block['height'] . '</td>';
        $html .= '	<td><input type="text" name="config_height" size="5" value="' . $data_block['height'] . '"/>&nbsp;px</td>';
        $html .= '</tr>';
        return $html;
    }

    function nv_block_config_iframe_blocks_submit ( $module, $lang_block )
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['url'] = $nv_Request->get_string( 'config_url', 'post', 0 );
        $return['config']['width'] = $nv_Request->get_int( 'config_width', 'post', 0 );
        $return['config']['height'] = $nv_Request->get_int( 'config_height', 'post', 0 );
        return $return;
    }

    function nv_iframe_blocks( $block_config )
    {
        global $global_config, $site_mods;

        if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.block_iframe.tpl' ) )
        {
            $block_theme = $global_config['module_theme'];
        }
        elseif( file_exists( NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.block_iframe.tpl' ) )
        {
            $block_theme = $global_config['site_theme'];
        }
        else
        {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate( 'global.block_iframe.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks' );
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
        $xtpl->assign( 'BLOCK_THEME', $block_theme );
        $xtpl->assign( 'DATA', $block_config );
        $xtpl->parse( 'main' );
        return $xtpl->text( 'main' );
    }
}

if ( defined( 'NV_SYSTEM' ) )
{
    $content = nv_iframe_blocks( $block_config );
}

?>
