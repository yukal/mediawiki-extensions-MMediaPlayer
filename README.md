# mediawiki-extensions-MMediaPlayer

This extension attaches video-sources based on HTML5 and JWplayer to the MediaWiki pages by internal and external links

### Requires
- MediaWiki >= 1.29.0
- PHP >= 7.0

## Install
See how to [install extensions](https://www.mediawiki.org/wiki/Manual:Extensions#Installing_an_extension)

Download, unpack, rename the unpacked directory to `MMediaPlayer` and then just put this directory with the scripts into `MediaWiki` extensions directory.

Find the `LocalSettings.php` file in the root of `MediaWiki` directory and paste this code
```php
// Activate extension
wfLoadExtension( 'MMediaPlayer' );
```

### Usage
html5 video player:
```
{{#video-html5: VIDEO_FILE_URL | VIDEO_WIDTH | VIDEO_HEIGHT}}
{{#video-html5:http://domain/video-file.mp4|640|480}}
{{#video-html5:http://domain/video-file.mp4}}
```

jwplayer:
```
{{#video-jwplayer: VIDEO_FILE_URL | IMAGE_FILE_URL | VIDEO_WIDTH | VIDEO_HEIGHT}}
{{#video-jwplayer:https://domain/video-file.mp4|https://domain.zone/video-image.jpg|640|480}}
{{#video-jwplayer:https://domain/video-file.mp4||640|480}}
{{#video-jwplayer:https://domain/video-file.mp4}}
```
