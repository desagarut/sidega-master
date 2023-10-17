function minify($buffer)
{
    $search = [
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s',       // shorten multiple whitespace sequences
    ];

    $replace = [
        '>',
        '<',
        '\\1',
    ];

    $buffer = preg_replace($search, $replace, $buffer);

    //replaces
    $buffer = str_replace(' type="text/javascript"', '', $buffer);
    $buffer = str_replace(' type="text/css"', '', $buffer);

    //replace style elements
    $buffer = preg_replace_callback("/<style>([\s\S]*?)<\/style>/", function ($matches) {
        //minify the css
        $css = $matches[1];
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

        $css = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '     '], '', $css);

        $css = preg_replace(['(( )+{)', '({( )+)'], '{', $css);
        $css = preg_replace(['(( )+})', '(}( )+)', '(;( )*})'], '}', $css);
        $css = preg_replace(['(;( )+)', '(( )+;)'], ';', $css);

        return '<style>'.$css.'</style>';
    }, $buffer);

    //replace script elements
    $buffer = preg_replace_callback("/<script>([\s\S]*?)<\/script>/", function ($matches) {
        $minifiedCode = JSMin::minify($matches[1]);

        return '<script>'.$minifiedCode.'</script>';
    }, $buffer);

    return $buffer;
}