<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    Albums Albums
 * @ingroup     TridentModules
 *
 * @{
 */

bx_import('BxBaseModTextConfig');

class BxAlbumsConfig extends BxBaseModTextConfig
{
    function __construct($aModule)
    {
        parent::__construct($aModule);

        $this->CNF = array (

            // database tables
            'TABLE_ENTRIES' => $aModule['db_prefix'] . 'albums',

            // database fields
            'FIELD_ID' => 'id',
            'FIELD_AUTHOR' => 'author',
            'FIELD_ADDED' => 'added',
            'FIELD_CHANGED' => 'changed',
            'FIELD_TITLE' => 'title',
            'FIELD_TEXT' => 'text',
            'FIELD_TEXT_ID' => 'album-desc',
            'FIELD_ALLOW_VIEW_TO' => 'allow_view_to',
            'FIELD_PHOTO' => 'pictures',
            'FIELD_THUMB' => 'thumb',
            'FIELD_COMMENTS' => 'comments',
            'FIELD_LOCATION_PREFIX' => 'location',

            // page URIs
            'URI_VIEW_ENTRY' => 'view-album',
            'URI_AUTHOR_ENTRIES' => 'albums-author',
            'URI_ADD_ENTRY' => 'create-album',
        	'URI_EDIT_ENTRY' => 'edit-album',
        	'URI_MANAGE_COMMON' => 'albums-manage',

            'URL_HOME' => 'page.php?i=albums-home',
            'URL_POPULAR' => 'page.php?i=albums-popular',
        	'URL_MANAGE_COMMON' => 'page.php?i=albums-manage',
        	'URL_MANAGE_MODERATION' => 'page.php?i=albums-moderation',
        	'URL_MANAGE_ADMINISTRATION' => 'page.php?i=albums-administration',

            // some params
            'PARAM_CHARS_SUMMARY' => 'bx_albums_summary_chars',
            'PARAM_CHARS_SUMMARY_PLAIN' => 'bx_albums_plain_summary_chars',
            'PARAM_NUM_RSS' => 'bx_albums_rss_num',

            // objects
            'OBJECT_STORAGE' => 'bx_albums_files',
            'OBJECT_IMAGES_TRANSCODER_PREVIEW' => 'bx_albums_proxy_preview',
            'OBJECT_VIDEOS_TRANSCODERS' => array('poster' => 'bx_albums_video_poster', 'mp4' => 'bx_albums_video_mp4', 'webm' => 'bx_albums_video_webm'),
            'OBJECT_TRANSCODER_BROWSE' => 'bx_albums_proxy_browse',
            'OBJECT_VIEWS' => 'bx_albums',
            'OBJECT_VOTES' => 'bx_albums',
            'OBJECT_METATAGS' => 'bx_albums',
            'OBJECT_COMMENTS' => 'bx_albums',
            'OBJECT_PRIVACY_VIEW' => 'bx_albums_allow_view_to',
            'OBJECT_FORM_ENTRY' => 'bx_albums',
            'OBJECT_FORM_ENTRY_DISPLAY_VIEW' => 'bx_albums_entry_view',
            'OBJECT_FORM_ENTRY_DISPLAY_ADD' => 'bx_albums_entry_add',
            'OBJECT_FORM_ENTRY_DISPLAY_EDIT' => 'bx_albums_entry_edit',
            'OBJECT_FORM_ENTRY_DISPLAY_DELETE' => 'bx_albums_entry_delete',
            'OBJECT_MENU_ACTIONS_VIEW_ENTRY' => 'bx_albums_view', // actions menu on view entry page
            'OBJECT_MENU_ACTIONS_MY_ENTRIES' => 'bx_albums_my', // actions menu on my entries page
            'OBJECT_MENU_SUBMENU' => 'bx_albums_submenu', // main module submenu
            'OBJECT_MENU_SUBMENU_VIEW_ENTRY' => 'bx_albums_view_submenu', // view entry submenu
            'OBJECT_MENU_SUBMENU_VIEW_ENTRY_MAIN_SELECTION' => 'albums-home', // first item in view entry submenu from main module submenu
            'OBJECT_MENU_MANAGE_TOOLS' => 'bx_albums_menu_manage_tools', //manage menu in content administration tools
            'OBJECT_GRID_ADMINISTRATION' => 'bx_albums_administration',
        	'OBJECT_GRID_MODERATION' => 'bx_albums_moderation',
        	'OBJECT_GRID_COMMON' => 'bx_albums_common',

            // menu items which visibility depends on custom visibility checking
            'MENU_ITEM_TO_METHOD' => array (
                'bx_albums_my' => array (
                    'create-album' => 'checkAllowedAdd',
                ),
                'bx_albums_view' => array (
                    'edit-album' => 'checkAllowedEdit',
                    'delete-album' => 'checkAllowedDelete',
                ),
            ),

            // some language keys
            'T' => array (
                'txt_sample_single' => '_bx_albums_txt_sample_single',
            	'txt_sample_comment_single' => '_bx_albums_txt_sample_comment_single',
            	'grid_action_err_delete' => '_bx_albums_grid_action_err_delete',
				'filter_item_active' => '_bx_albums_grid_filter_item_title_adm_active',
            	'filter_item_hidden' => '_bx_albums_grid_filter_item_title_adm_hidden',
            	'filter_item_select_one_filter1' => '_bx_albums_grid_filter_item_title_adm_select_one_filter1',
            	'menu_item_manage_my' => '_bx_albums_menu_item_title_manage_my',
            	'menu_item_manage_all' => '_bx_albums_menu_item_title_manage_all',
            ),
        );

        $this->_aJsClass = array(
        	'manage_tools' => 'BxAlbumsManageTools'
        );

        $this->_aJsObjects = array(
        	'manage_tools' => 'oBxAlbumsManageTools'
        );

        $this->_aGridObjects = array(
        	'common' => $this->CNF['OBJECT_GRID_COMMON'],
        	'moderation' => $this->CNF['OBJECT_GRID_MODERATION'],
        	'administration' => $this->CNF['OBJECT_GRID_ADMINISTRATION'],
        	
        );
    }
}

/** @} */