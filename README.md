# MMediaPlayer
The Media player Extension for the MediaWiki engine

### Install
- Download extension
- Unpack extension: `tar xzf extension_name.tar.gz`
- Rename unpacked extension directory to MMediaPlayer
- Copy MMediaPlayer to MediaWiki extensions
- Set permissions of MMediaPlayer directory to a web user
- Activate extension in LocalSettings.php

To activate this extension, add the following into your LocalSettings.php file:
wfLoadExtension( 'MMediaPlayer' );

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
