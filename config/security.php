<?php

/*
|--------------------------------------------------------------------------
| Security configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Extensions allowed when uploading audio.
     *
     * array
     */
    'exts_audio_valid' => [
        'wav', 'mpeg', 'mp3', 'aac', 'aacp', 'ogg', 'flac',
    ],

    /**
     * Extensions allowed when uploading documents (Excel files, etc.).
     *
     * array
     */
    'exts_doc_valid' => [
        'xlsx', 'csv', 'ods', 'odt',
    ],

    /**
     * Extensions allowed when uploading images.
     *
     * array
     */
    'exts_img_valid' => [
        'png', 'webp', 'jpg', 'jpe', 'jpeg', 'gif', 'ico',
        'bmp', 'wbmp', 'ai', 'psd', 'swf', 'tif', 'tiff',
    ],

    /**
     * Extensions allowed when uploading video.
     *
     * array
     */
    'exts_video_valid' => [
        'webm', 'mp4', 'ogv',
    ],

    /**
     * Extensions allowed when uploading files.
     *
     * array
     */
    'exts_other_valid' => [
        'txt', 'zip', 'pdf', 'wawe', 'aif', 'm4a', 'wma', 'ogv',
    ],

];
