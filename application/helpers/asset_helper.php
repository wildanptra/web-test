<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('asset_url'))
{
    function asset_url($asset_name, $asset_type = NULL) {
        $obj = & get_instance();
        $base_url = $obj->config->item('base_url');
        // $asset_root = 'assets/';
        $asset_root = 'assets/';
        $asset_location = $base_url . $asset_root;
    	if (is_array($asset_name))
    	{
    		$cachename = md5(serialize($asset_name));
    		$asset_location .= 'cache/' . $cachename . '.' . $asset_type;
    		if(!is_file($asset_root . 'cache/' . $cachename . '.' . $asset_type))
    		{
    			$out = fopen($asset_root . 'cache/' . $cachename . '.' . $asset_type, "w");
    			foreach($asset_name as $file)
    			{
    				$file_content = file_get_contents($asset_root . $asset_type . '/' . $file);
    				fwrite($out, $file_content);
    			}
    			fclose($out);
    		}
    	}
    	else
    	{
    		$asset_location .= $asset_type . '/' . $asset_name;
    	}
        return $asset_location;
    }
}

if ( ! function_exists('css_asset'))
{
    function css_asset($asset_name,$attributes = array()) {
        $attribute_str = _parse_asset_html($attributes);
        return '<link href="' . asset_url($asset_name,'common/css') . '" rel="stylesheet" type="text/css"' . $attribute_str . ' />';
    }
}

if ( ! function_exists('js_asset'))
{
    function js_asset($asset_name) {
    	return '<script type="text/javascript" src="' . asset_url($asset_name,'common/js') . '"></script>';
    }
}

if ( ! function_exists('plugins_asset'))
{
    function plugins_asset($asset_name, $type = 'js', $attributes = array()) {
        if($type == 'css'){
            $attribute_str = _parse_asset_html($attributes);
            return '<link href="' . asset_url($asset_name,'plugin') . '" rel="stylesheet" type="text/css"' . $attribute_str . ' />';
        } else {
            return '<script type="text/javascript" src="' . asset_url($asset_name,'js/plugin') . '"></script>';
        }
    }
}

if ( ! function_exists('helpers_asset'))
{
    function helpers_asset($asset_name, $type = 'js', $attributes = array()) {
        if($type == 'css'){
            $attribute_str = _parse_asset_html($attributes);
            return '<link href="' . asset_url($asset_name,'helpers') . '" rel="stylesheet" type="text/css"' . $attribute_str . ' />';
        } else {
            return '<script type="text/javascript" src="' . asset_url($asset_name,'helpers') . '"></script>';
        }
    }
}

if ( ! function_exists('vendors_asset'))
{
    function vendors_asset($asset_name, $type = 'js', $attributes = array()) {
        if($type == 'css'){
            $attribute_str = _parse_asset_html($attributes);
            return '<link href="' . asset_url($asset_name,'vendors') . '" rel="stylesheet" type="text/css"' . $attribute_str . ' />';
        } else {
            return '<script type="text/javascript" src="' . asset_url($asset_name,'vendors') . '"></script>';
        }
    }
}

if ( ! function_exists('crossbrowserjs_asset'))
{
    function crossbrowserjs_asset($asset_name) {
        return '<script type="text/javascript" src="' . asset_url($asset_name,'crossbrowserjs') . '"></script>';
    }
}

if ( ! function_exists('image_asset'))
{
    function image_asset($asset_name, $module_name = '', $attributes = array()) {
    	$attribute_str = _parse_asset_html($attributes);
    	return '<img src="' . asset_url($asset_name,'common/img') . '"' . $attribute_str . ' />';
    }
}

if ( ! function_exists('favicon_asset'))
{
    function favicon_asset($asset_name, $rel = 'icon', $url = 'favicon', $type = 'type="image/x-icon"') {
		$asset_location = $base_url . $asset_root . 'img/'.$url.'/'.$asset_name;
        return '<link href="' . $asset_location . '" rel="'.$rel.'" ' . $type . ' />';
    }
}

if ( ! function_exists('_parse_asset_html'))
{
    function _parse_asset_html($attributes = NULL) {
        if(is_array($attributes)):
            $attribute_str = '';
            foreach ($attributes as $key => $value):
                $attribute_str .= ' ' . $key . '="' . $value . '"';
            endforeach;
            return $attribute_str;
        endif;
    	return '';
    }
}

function load_asset($url='', $type='')
{
        $obj = & get_instance();
        $base_url = $obj->config->item('base_url');
        $asset_root = 'assets/assets-v2/';
        $asset_location = $base_url . $asset_root.$url;
        return $asset_location;
}
