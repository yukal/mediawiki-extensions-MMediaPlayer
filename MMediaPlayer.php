<?php
/**
 * MMediaPlayer Extension
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * wfLoadExtension( 'MMediaPlayer' );
 *
 * @file
 * @ingroup Extensions
 * @version 1.0
 * @author Alexander Yukal <yukal@email.ua>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link https://www.mediawiki.org/wiki/Extension:MMediaPlayer
 * @link https://www.mediawiki.org/wiki/Manual:Extensions
 * @link https://www.mediawiki.org/wiki/Manual:Extension_registration
 * @link https://www.mediawiki.org/wiki/Manual:Configuration_settings
 * @link https://www.mediawiki.org/wiki/ResourceLoader/Core_modules
 * @link https://www.mediawiki.org/wiki/Manual:Special_pages
 * @link https://www.mediawiki.org/wiki/Localisation
 * @link https://doc.wikimedia.org/
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
