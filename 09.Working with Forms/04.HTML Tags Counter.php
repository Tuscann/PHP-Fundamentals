<?php session_start(); ?>
    <label>
        Enter HTML tags:
    </label>

    <form action="" method="get">
        <br>
        <input type="text" name="tags" required>
        <input type="submit" name="Submit">
    </form>
<?php

if (isset($_GET['tags'])) {

    if (isset($_SESSION["counter"]) == false) {
        $_SESSION['tags'] = 0;
    }
    $allowTags = ["!DOCTYPE", "a", "abbr", "acronym", "address", "applet", "area", "article", "aside", "audio", "b", "base", "basefont", "bdi", "bdo", "big", "blockquote", "body", "br", "button", "canvas", "caption", "center", "cite", "code", "col", "colgroup", "datalist", "dd", "del", "details", "dfn", "dialog", "dir", "div", "dl", "dt", "em", "embed", "fieldset", "figcaption", "figure", "font", "footer", "form", "frame", "frameset", "h1 to h6", "head", "header", "hr", "html", "i", "iframe", "img", "input", "ins", "kbd", "keygen", "label", "legend", "li", "link", "main", "map", "mark", "menu", "menuitem", "meta", "meter", "nav", "noframes", "noscript", "object", "ol", "optgroup", "option", "output", "p", "param", "picture", "pre", "progress", "q", "rp", "rt", "ruby", "s", "samp", "script", "section", "select", "small", "source", "span", "strike", "strong", "style", "sub", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "title", "tr", "track", "tt", "u", "ul", "var", "video", "wbr"];

    $inputTags = $_GET['tags'];

    if (in_array($inputTags, $allowTags)) {
        $_SESSION["counter"]++;
        echo "<h1>Valid HTML tag!</h1>" . "<br>";
    } else {
        echo "Invalid HTML Tag!" . "<br>";
    }
    echo "Score: " . $_SESSION["counter"];


}