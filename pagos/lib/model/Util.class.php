<?php
/**
 * Description of Util
 *
 * @author Jacobo Martinez
 */
class Util {
    // code derived from http://php.vrana.cz/vytvoreni-pratelskeho-url.php
    static public function slugify($text) {
        // replace non letter or digits by _
        $text = preg_replace('#[^\\pL\d]+#u', '_', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text)) {
          return 'n-a';
        }

        return $text;
    }
}

?>
