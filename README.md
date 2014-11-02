rxx/colors
==========

This tiny one-class library provides a set of static methods implementing convenient ANSI color printing for PHP CLI apps via inline formatting codes.

Usage
-----

Simply require the composer package and use the methods found in the class RXX\Colors\Colors.

The most convenient method is **Colors::cprint**, which requires at least one argument, a string containing color formatting codes. These codes follow the syntax "**%fb;**", as follows:

* **%** is a literal percent sign identifying the beginning of the code
* **f** is a foreground color identifier (see below); if uppercase, it is the bold version of the color; if "x", the code becomes an ANSI reset
* **b** is an optional background color identifier (see below); if omitted, the background defaults to black
* **;** is an optional literal semicolon identifying the end of the code

Color identifiers:

* k = black
* r = red
* g = green
* y = yellow
* b = blue
* m = magenta
* c = cyan
* w = white
* x = reset

By default, cprint echoes the formatted string, appending a newline and an ANSI reset. The method takes optional arguments to toggle these behaviors:

```php
public static function cprint($msg, $appendNewline = true, $autoReset = true, $return = false)
```

If **$appendNewline** is true, a newline is appended to the input.
If **$autoReset** is true, an ANSI reset code is appended to the output. If **$return** is true, the resulting string is returned rather than echoed.

The other methods are either used indirectly by cprint or are for niche purposes. The source is mostly self-explanatory (code language for "I'm too lazy to document this right now"). Mess around with it as you please.

Examples
--------

```php
require_once __DIR__ . '/../vendor/autoload.php';

use RXX\Colors\Colors;

// basic usage
Colors::cprint('%b;various %c;shades %B;of %C;blue');
Colors::cprint('%Rw;red on white');

// bars in blue and red
Colors::cprint('%kB;     %x;     %kR;     ');

// returning a string, without newline
$bright = Colors::cprint('%Y;YELLOW!', false, true, true);
echo "bright '{$bright}'\n";

// continuing color without reset
Colors::cprint('w listing in bright green on blue:%Gb;', true, false);
system('w');

// print newline and reset
Colors::cprint('');
```

License
-------
Copyright (C) 2013 Joe Lafiosca <joe@lafiosca.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

