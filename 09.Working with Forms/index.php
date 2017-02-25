<?php
declare(strict_types = 1);
session_start();

if (isset($_GET["submit"])) {
    $tags = explode(", ", trim($_GET["tags"]));

    if (!isset($_SESSION["tags"])) {
        $_SESSION["tags"] = [];
    }

    if (count($tags) > 0) {
        foreach ($tags as $tag) {
            if (!array_key_exists($tag, $_SESSION["tags"])) {
                $_SESSION["tags"][$tag] = 0;
            }

            $_SESSION["tags"][$tag]++;
        }

        $tags = $_SESSION["tags"];

        uasort($tags, function ($a, $b) {
            return $b <=> $a;
        });

        $mostFrequentTag = array_keys($tags)[0];
    }
} else if (isset($_GET["clear"])) {
    session_destroy();
}

require_once "view.php";