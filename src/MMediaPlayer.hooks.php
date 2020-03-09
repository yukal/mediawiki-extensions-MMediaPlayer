<?php
/**
 * MMediaPlayer Hooks
 * https://www.mediawiki.org/wiki/Manual:Hooks
 * https://www.mediawiki.org/wiki/Template:MediaWikiHook
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

        return true;
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
     * @see https://www.mediawiki.org/wiki/ResourceLoader/Developing_with_ResourceLoader
     *
     * @param  object $parser The Parser object
     * @param  string $src URL link to a video file
     * @param  integer $width Video-frame width
     * @param  integer $height Video-frame height
     *
     * @return string|array 
     */
    public static function renderHtml5Player(Parser $parser, $src='', $width=0, $height=0) {
        $output = '';

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
        }

        return strlen($output) > 0
            ? [ $output, 'noparse' => true, 'isHTML' => true ]
            : '<video-unknown-format>'
        ;
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
     * @see https://www.mediawiki.org/wiki/ResourceLoader/Developing_with_ResourceLoader
     *
     * @param  object $parser The Parser object
     * @param  string $video_src URL link to a video file
     * @param  string $img_src URL link to a picture of the video file
     * @param  integer $width Video-frame width
     * @param  integer $height Video-frame height
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

        // $parser->getOutput()->addHeadItem('jwplayer-script', '<script src="/extensions/MMediaPlayer/static/jwplayer.js"></script>');
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
