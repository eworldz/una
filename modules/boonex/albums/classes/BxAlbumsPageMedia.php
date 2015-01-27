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

bx_import('BxDolModule');
bx_import('BxTemplPage');

/**
 * Entry create/edit pages
 */
class BxAlbumsPageMedia extends BxTemplPage
{
    protected $MODULE;
    protected $_oModule;
    protected $_aAlbumInfo = false;
    protected $_aMediaInfo = false;
    protected $_mixedContext = false;

    public function __construct($aObject, $oTemplate = false)
    {        
        parent::__construct($aObject, $oTemplate);
        $this->MODULE = 'bx_albums';
        $this->_oModule = BxDolModule::getInstance($this->MODULE);
        $CNF = &$this->_oModule->_oConfig->CNF;

        $iMediaId = bx_process_input(bx_get('id'), BX_DATA_INT);
        if ($iMediaId)
            $this->_aMediaInfo = $this->_oModule->_oDb->getMediaInfoById($iMediaId);

        if ($this->_aMediaInfo)
            $this->_aAlbumInfo = $this->_oModule->_oDb->getContentInfoById($this->_aMediaInfo['content_id']);

        if ($this->_aAlbumInfo) {
            $this->addMarkers(array_merge($this->_aAlbumInfo, $this->_aMediaInfo)); // every field can be used as marker
            $this->addMarkers(array(
                'title' => !empty($this->_aMediaInfo['title']) ? $this->_aMediaInfo['title'] : _t('_bx_albums_txt_media_title_alt', $this->_aAlbumInfo[$CNF['FIELD_TITLE']]),
            ));
        }
    }

    public function getCode ()
    {
        // check if content exists
        if (!$this->_aAlbumInfo || !$this->_aMediaInfo) { // if entry is not found - display standard "404 page not found" page
            $this->_oTemplate->displayPageNotFound();
            exit;
        }

        // permissions check 
        if (CHECK_ACTION_RESULT_ALLOWED !== ($sMsg = $this->_oModule->checkAllowedView($this->_aAlbumInfo))) {
            $this->_oTemplate->displayAccessDenied($sMsg);
            exit;
        }
        $this->_oModule->checkAllowedView($this->_aAlbumInfo, true);
/* TODO:
        // add content metatags
        if (!empty($CNF['OBJECT_METATAGS'])) {
            bx_import('BxDolMetatags');
            $o = BxDolMetatags::getObjectInstance($CNF['OBJECT_METATAGS']);
            if ($o) {
                $aThumb = false;
                if (!empty($CNF['FIELD_THUMB']) && !empty($this->_aContentInfo[$CNF['FIELD_THUMB']]) && !empty($CNF['OBJECT_STORAGE']))
                    $aThumb = array('id' => $this->_aContentInfo[$CNF['FIELD_THUMB']], 'object' => $CNF['OBJECT_STORAGE']);
                $o->metaAdd($this->_aContentInfo[$CNF['FIELD_ID']], $aThumb);
            }
        }
*/

        $aVars = array();
        $this->_oTemplate->addInjection ('injection_footer', 'text', $this->_oModule->_oTemplate->parseHtmlByName('photoswipe.html', $aVars));

        return parent::getCode ();
    }

    protected function _addJsCss()
    {
        $this->_oModule->_oTemplate->addCss(array(
            BX_DOL_URL_PLUGINS_PUBLIC . 'photo-swipe/photoswipe.css',
            BX_DOL_URL_PLUGINS_PUBLIC . 'photo-swipe/default-skin/default-skin.css',
        ));

        $this->_oModule->_oTemplate->addJs(array(
            'media_view.js',
            'history.js',
            'photo-swipe/photoswipe.min.js',
            'photo-swipe/photoswipe-ui-default.min.js',
        ));
    }
}

/** @} */