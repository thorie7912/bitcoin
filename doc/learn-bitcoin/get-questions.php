<?php

$ids = json_decode(filter_input(INPUT_GET, 'q'));

if (!is_array($ids) || empty($ids)) {
    exit;
}

$data = file_get_contents('db.json');
$data = json_decode($data, true);

//header("Content-type: text/plain");
$allTags = [];
foreach ($ids as $id) {
    if (!is_numeric($id) || !isset($data[$id]['tags'])) {
        continue;
    }
    foreach ($data[$id]['tags'] as $tag) {
        $allTags[$tag] = true;
    }
}

echo "<div class=\"all-tags\">Filter: ";
foreach (array_keys($allTags) as $tag) {
    $tag = strtoupper($tag);
    echo "<span class=\"tag\">$tag</span>";
}
echo "</div><!-- all-tags -->";

foreach ($ids as $id) {
    if (!is_numeric($id) || !isset($data[$id])) {
        echo "<div class=\"error\">Unable to load question " . (int)$id . "</div><!-- error -->";
        continue;
    }
    echo "<div class=\"question\"><a class=\"q-title\" href='#' data=\"$id\"><span class='triangle' id='triangle$id'>&#9654;</span> " . parse($data[$id]['q']) . "</a></div><!-- question -->";

    echo "<div class=\"expand\" id=\"expand$id\">";
    echo "<div class=\"tags\">";
    if (!empty($data[$id]['tags'])) {
      foreach ($data[$id]['tags'] as $tag) {
        $tag = strtoupper($tag);
        echo "<span class=\"tag\">$tag</span>";
      }
    }
    echo "</div><!-- tags -->";
    if (!empty($data[$id]['a'])) {
      echo "<div class=\"answer\" id=\"answer$id\">" . parse($data[$id]['a']) . "</div><!-- answer -->";
    }
    if (!empty($data[$id]['see'])) {
      echo "<div class=\"see\" id=\"answer$id\">See also<br><ul>";
      foreach ($data[$id]['see'] as $link) {
        echo "<li><a href=\"{$link['url']}\" target=\"__blank\">{$link['name']}</a></li>";
      }
      echo "</ul></div><!-- see -->";
    }
    echo "</div><!-- expand -->";




}

    echo "<script>registerTitles();</script>";
    echo "<hr>";
    echo "<a href='https://github.com/thorie7912/learn-bitcoin'>Submit a Question</a>";

function parse($str)
{
    $str = preg_replace("#`(.*?)`#", "<span class=\"q-code\">$1</span>", $str);
    return $str;
}



