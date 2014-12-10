<?php

/**
 * Helper class that contains useful config variables for rendering
 * your galleries.
 *
 * The static variables are called by Gallery Page Controller on initilisation
 *
 */
class GalleryConfig extends Object {
    /**
     * Max width of the gallery image
     *
     * @var Int
     * @config
     */
    private static $width = 950;

    /**
     * Max height of the gallery image
     *
     * @var Int
     * @config
     */
    private static $height = 500;
    
    /**
     * If image is padded, use this as the background 
     *
     * @var String
     * @config
     */
    private static $background = "ffffff";

    /**
     * Max width of the thumbnail image
     *
     * @var Int
     * @config
     */
    private static $thumb_width = 150;

    /**
     * Max height of the thumbnail image
     *
     * @var Int
     * @config
     */
    private static $thumb_height = 100;

    /**
     * Specify the type of resize we use, either:
     *
     * - crop: Crop image to exact size
     * - pad: Pad image to size and add whitespace
     * - ratio: Perform a ratio resize of images (NOTE: this has been known to
     *          cause issues in older version of IE
     *
     * @var String
     * @config
     */
    private static $resize_type = 'crop';

    /**
     * Set the width and height of the gallery images
     *
     * @param $width width of the images
     * @param $height height of the images
     */
    public static function setDimensions($width, $height) {
        self::config()->width = $width;
        self::config()->height = $height;
    }

    /**
     * Set the width and height of the thumbnail images
     *
     * @param $width width of the images
     * @param $height height of the images
     */
    public static function setThumbDimensions($width, $height) {
        self::config()->thumb_width = $width;
        self::config()->thumb_height = $height;
    }

    /**
     * Set the resize type
     *
     * @param $width width of the images
     */
    public static function setResizeType($type) {
        self::config()->resize_type = $type;
    }

    public static function getWidth() {
        return self::config()->width;
    }

    public static function getHeight() {
        return self::config()->height;
    }

    public static function getThumbWidth() {
        return self::config()->thumb_width;
    }

    public static function getThumbHeight() {
        return self::config()->thumb_height;
    }

    public static function getResizeType() {
        return self::config()->resize_type;
    }
}
