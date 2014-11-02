<?php

namespace RXX\Colors;

class Colors
{
    const BLACK = '0';
    const RED = '1';
    const GREEN = '2';
    const YELLOW = '3';
    const BLUE = '4';
    const MAGENTA = '5';
    const CYAN = '6';
    const WHITE = '7';

    protected static $flags = array(
        'k' => self::BLACK,
        'r' => self::RED,
        'g' => self::GREEN,
        'y' => self::YELLOW,
        'b' => self::BLUE,
        'm' => self::MAGENTA,
        'c' => self::CYAN,
        'w' => self::WHITE,
    );

    public static function reset()
    {
        return "\001\033[0m\002";
    }

    public static function color($fg = self::WHITE, $bold = false, $bg = self::BLACK)
    {
        return "\001\033[" . ($bold ? '1' : '0') . ";3{$fg};4{$bg}m\002";
    }

    public static function cecho($msg, $fg = self::WHITE, $bold = false, $bg = self::BLACK)
    {
        echo self::cstr($msg, $fg, $bold, $bg);
    }

    public static function cstr($msg, $fg = self::WHITE, $bold = false, $bg = self::BLACK)
    {
        return self::color($fg, $bold, $bg) . $msg . self::reset();
    }

    public static function cprint($msg, $appendNewline = true, $autoReset = true, $return = false)
    {
        $output = preg_replace_callback(
            '#%(x|[krgybmcw]{1,2});?#i',
            'self::cprintCallback',
            $msg
        );

        if ($autoReset) {
            $output .= self::reset();
        }

        if ($appendNewline) {
            $output .= "\n";
        }

        if ($return) {
            return $output;
        }

        echo $output;
    }

    public static function black($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::BLACK, $bold, $bg);
    }

    public static function red($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::RED, $bold, $bg);
    }

    public static function green($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::GREEN, $bold, $bg);
    }

    public static function yellow($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::YELLOW, $bold, $bg);
    }

    public static function blue($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::BLUE, $bold, $bg);
    }

    public static function magenta($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::MAGENTA, $bold, $bg);
    }

    public static function cyan($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::CYAN, $bold, $bg);
    }

    public static function white($msg, $bold = false, $bg = self::BLACK) {
        return self::cstr($msg, self::WHITE, $bold, $bg);
    }

    protected static function cprintCallback($matches)
    {
        $fg = strtolower($matches[1]{0});

        if ($fg === 'x') {
            return self::reset();
        }

        $bold = ctype_upper($matches[1]{0});

        if (strlen($matches[1]) === 1) {
            $bg = 'k';
        } else {
            $bg = strtolower($matches[1]{1});
        }

        return self::color(self::$flags[$fg], $bold, self::$flags[$bg]);
    }
}
