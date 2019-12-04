<?php
/**
 * MMediaPlayer Hooks
 *
 * @file
 * @ingroup Extensions
 * @version 1.0
 * @author Alexander Yukal <yukal@email.ua>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link https://www.mediawiki.org/wiki/Extension:MMediaPlayer Documentation
 */

class MMediaPlayerHooks {
    private static $defaultWidth = 854;
    private static $defaultHeight = 480;

    /**
     * onParserFirstCallInit
     *
     * @see https://www.mediawiki.org/wiki/Manual:Hooks
     * @see https://www.mediawiki.org/wiki/Manual:Parser.php
     * @see https://www.mediawiki.org/wiki/Manual:ParserOutput.php
     * @see https://doc.wikimedia.org/mediawiki-core/1.33.1/php/classParser.html
     *
     * @param  object $parser The Parser object
     *
     * @return void
     */
    public static function onParserFirstCallInit(Parser $parser) {
        $parser->setFunctionHook('video-html5', [self::class, 'renderHtml5Player']);
        $parser->setFunctionHook('video-jwplayer', [self::class, 'renderJWPlayer']);
        // $parser->setHook('video-container', 'renderContainer');

        return true;
    }

    /**
     * onBeforePageDisplay
     * Allows last minute changes to the output page, e.g. adding of CSS or JavaScript by extensions
     *
     * @see https://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
     * @see https://www.mediawiki.org/wiki/Manual:OutputPage.php
     * @see https://doc.wikimedia.org/mediawiki-core/1.33.1/php/classOutputPage.html
     * @see https://doc.wikimedia.org/mediawiki-core/1.33.1/php/classSkin.html
     *
     * @param  object $out The OutputPage object
     * @param  object $skin Skin object that will be used to generate the page
     *
     * @return void
     */
    public static function onBeforePageDisplay(OutputPage $out, Skin $skin) {
        $out->addHeadItem('jwplayer', '<script src="https://cdn.jwplayer.com/libraries/your_id_of_jwplayer.js"></script>');
        // $out->addHeadItem('jwplayer', '<script src="/extensions/MMediaPlayer/static/jwplayer.js"></script>');
        // $out->addScriptFile('/extensions/MMediaPlayer/static/jwplayer.js');
    }

    /**
     * renderHtml5Player
     * Render the output of html5 video by mask: {{#video-html5:*}}
     * Usage: {{#video-html5:FILE_URL|WIDTH|HEIGHT}}
     * Usage: {{#video-html5:FILE_URL}}
     *
     * @see https://www.mediawiki.org/wiki/Manual:Parser_functions
     * @see https://www.mediawiki.org/wiki/Manual:Parser.php
     * @see https://www.mediawiki.org/wiki/Manual:ParserOutput.php
     * @see https://doc.wikimedia.org/mediawiki-core/1.33.1/php/classParser.html
     *
     * @param  object $parser The Parser object
     * @param  string $src URL link to a video file
     * @param  integer $width Video-frame width
     * @param  integer $height Video-frame height
     *
     * @return string|array 
     */
    public static function renderHtml5Player(Parser $parser, $src='', $width=0, $height=0) {
        $output = '<video-unknown-format>';

        if (strlen($src) > 0) {
            $styles = [];

            if (gettype($width) == 'integer') {
                $width>0 && array_push($styles, "width:${width}px");
            }

            if (gettype($height) == 'integer') {
                $height>0 && array_push($styles, "height:${height}px");
            }

            $styles = count($styles) > 0 
                ? sprintf(' style="%s"', implode('; ', $styles)) : '';

            $template = '<video src="%s" controls%s></video>';
            $output = sprintf($template, $src, $styles);

            return [ $output, 'noparse' => true, 'isHTML' => true ];
        }

        return $output;
    }

    /**
     * renderJWPlayer
     * Render the output of jwplayer-container by mask: {{#video-jwplayer:*}}
     * Usage: {{#video-jwplayer:FILE_URL|IMAGE_URL|WIDTH|HEIGHT}}
     * Usage: {{#video-jwplayer:FILE_URL||WIDTH|HEIGHT}}
     * Usage: {{#video-jwplayer:FILE_URL}}
     *
     * @see https://www.mediawiki.org/wiki/Manual:Parser_functions
     * @see https://www.mediawiki.org/wiki/Manual:Parser.php
     * @see https://www.mediawiki.org/wiki/Manual:ParserOutput.php
     * @see https://doc.wikimedia.org/mediawiki-core/1.33.1/php/classParser.html
     *
     * @param  mixed $parser The Parser object
     * @param  mixed $video_src URL link to a video file
     * @param  mixed $img_src URL link to a picture of the video file
     * @param  mixed $width Video-frame width
     * @param  mixed $height Video-frame height
     *
     * @return string|array
     */
    public static function renderJWPlayer(Parser $parser, $video_src='', $img_src='', $width=0, $height=0) {
        $scriptTagId = uniqid();
        $id = "jwplayer-${scriptTagId}";

        $width = gettype($width) != 'integer' ? self::$defaultWidth 
            : ($width>0 ?$width :self::$defaultWidth);

        $height = gettype($height) != 'integer' ? self::$defaultHeight 
            : ($height>0 ?$height :self::$defaultHeight);

        $parser->getOutput()->addModules('ext.mMediaPlayer');
        $output = sprintf('<div id="%s" data-file="%s" data-image="%s" data-width="%d" data-height="%d"></div>', 
            $id, 
            $video_src, 
            $img_src, 
            $width, 
            $height
        );

        return [ $output, 'noparse' => true, 'isHTML' => true ];
    }

    // public static function renderContainer(Parser $parser, $type='html5', $src='', $width=0, $height=0) {
    //     ...
    // }
}
