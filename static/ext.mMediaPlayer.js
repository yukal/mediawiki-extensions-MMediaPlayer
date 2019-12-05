/**
 * MMediaPlayer JS Module
 *
 * MediaWiki Resource Module
 * Finds and activates all video elements on a page.
 *
 * MediaWiki Manual
 * https://doc.wikimedia.org/mediawiki-core/master/js/#!/api/mw
 * https://doc.wikimedia.org/mediawiki-core/master/js/#!/api/jQuery
 * https://www.mediawiki.org/wiki/Manual:$wgResourceModules
 * https://www.mediawiki.org/wiki/Adding_javascript_to_wiki_pages
 * https://www.mediawiki.org/wiki/ResourceLoader/Core_modules
 *
 * JWPlayer official website and documentation
 * https://developer.jwplayer.com/jwplayer/docs
 * https://www.jwplayer.com
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
