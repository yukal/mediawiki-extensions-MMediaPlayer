<?php
/**
 * MMediaPlayer Extension
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * wfLoadExtension( 'MMediaPlayer' );
 *
 * MediaWiki Manual
 * https://www.mediawiki.org/wiki/Manual:Extensions
 * https://www.mediawiki.org/wiki/Manual:Extension_registration
 * https://www.mediawiki.org/wiki/Manual:Extension.json/Schema
 * https://www.mediawiki.org/wiki/Manual:Configuration_settings
 * https://www.mediawiki.org/wiki/Manual:Special_pages
 * https://www.mediawiki.org/wiki/ResourceLoader/Core_modules
 * https://www.mediawiki.org/wiki/Localisation
 *
 * MediaWiki Documentation
 * https://doc.wikimedia.org/
 * https://doc.wikimedia.org/mediawiki-core/master/js/#!/api/mw
 * https://doc.wikimedia.org/mediawiki-core/master/js/#!/api/jQuery
 *
 * JWPlayer official website and documentation
 * https://www.jwplayer.com
 * https://developer.jwplayer.com/jwplayer/docs
 *
 * @file
 * @ingroup Extensions
 * @version 1.0
 * @author Alexander Yukal <yukal@email.ua>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link https://www.mediawiki.org/wiki/Extension:MMediaPlayer
 */

if ( function_exists( 'wfLoadExtension' ) ) {
    wfLoadExtension( 'MMediaPlayer' );
    // Keep i18n globals so mergeMessageFileList.php doesn't break
    $wgMessagesDirs['MMediaPlayer'] = __DIR__ . '/i18n';
    $wgExtensionMessagesFiles['MMediaPlayerAlias'] = __DIR__ . '/src/MMediaPlayer.alias.php';
    wfWarn(
        'Deprecated PHP entry point used for MMediaPlayer extension. '.
        'Please use wfLoadExtension instead, ' .
        'see https://www.mediawiki.org/wiki/Extension_registration'.
        ' /  https://www.mediawiki.org/wiki/Manual:Special_pages' .
        ' for more details.'
    );
    return;
} else {
    die( 'This version of the MMediaPlayer extension requires MediaWiki 1.29+' );
}
