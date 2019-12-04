/**
 * MMediaPlayer JS Module
 *
 * MediaWiki Resource Module
 * Finds and activates all video elements on a page.
 *
 * MediaWiki Manual
 * @link https://doc.wikimedia.org/mediawiki-core/master/js/#!/api/mw
 * @link https://doc.wikimedia.org/mediawiki-core/master/js/#!/api/jQuery
 * @link https://www.mediawiki.org/wiki/Manual:$wgResourceModules
 * @link https://www.mediawiki.org/wiki/Adding_javascript_to_wiki_pages
 * @link https://www.mediawiki.org/wiki/ResourceLoader/Core_modules
 *
 * JWPlayer official website and documentation
 * @link https://developer.jwplayer.com/jwplayer/docs
 * @link https://www.jwplayer.com
 *
 * @file
 * @ingroup Extensions
 * @version 1.0
 * @author Alexander Yukal <yukal@email.ua>
 * @license https://opensource.org/licenses/MIT MIT License
 */
(function ($, mw) {
    'use strict';

    var tags = document.querySelectorAll('[id^=jwplayer]');
    var item;

    for (item of tags) {
        var itemParameters = $(item).data();

        var settings = $.extend({
            flashplayer: 'jwplayer.swf',
            width: 854,
            height: 480,
            // file: 'https://domain/video.mp4',
            // image: 'https://domain/video.jpg',
            'controlbar.position': 'bottom',
        }, itemParameters);

        jwplayer(item.id).setup(settings);
    }

}(jQuery, mediaWiki));
