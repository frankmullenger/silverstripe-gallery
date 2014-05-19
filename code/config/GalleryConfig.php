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
        self::$width = $width;
        self::$height = $height;
    }

    /**
     * Set the width and height of the thumbnail images
     *
     * @param $width width of the images
     * @param $height height of the images
     */
    public static function setThumbDimensions($width, $height) {
        self::$thumb_width = $width;
        self::$thumb_height = $height;
    }

    /**
     * Set the resize type
     *
     * @param $width width of the images
     */
    public static function setResizeType($type) {
        self::$resize_type = $type;
    }

    public static function getWidth() {
        return self::$width;
    }

    public static function getHeight() {
        return self::$height;
    }

    public static function getThumbWidth() {
        return self::$thumb_width;
    }

    public static function getThumbHeight() {
        return self::$thumb_height;
    }

    public static function getResizeType() {
        return self::$resize_type;
    }
}
