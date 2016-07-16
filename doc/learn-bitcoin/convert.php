<?php

// This script converts source files into special @q annotated output files.

foreach (glob("../doxygen/html/*_source.html") as $filename) {
    //echo "Checking $filename\n";
    $fgc = file_get_contents($filename);
    $ret = preg_match_all('#@q([\d]+)#', $fgc, $matches);
    if (!empty($matches[1])) {
        echo "$filename: " . implode(', ', $matches[1]) . "\n";

        // Add css
        $fgc = preg_replace("#(</head>)#", "<link href=\"learn-bitcoin.css\" rel=\"stylesheet\" type=\"text/css\" />\n$1", $fgc);

        // Add left and right panes
        $fgc = preg_replace("#(<div class=\"fragment\">)#", "<div class=\"left-pane\">$1", $fgc);
        $fgc = preg_replace("#(</div><!-- fragment -->)#", "$1</div><!-- left-pane --><div class=\"right-pane\"></div><!-- right-pane -->", $fgc);

        // Add js
        $fgc = preg_replace("#(</body>)#", "<script src=\"learn-bitcoin.js\"></script>\n$1", $fgc);

        // Convert question #'s into element data
        $questionIds = '['.implode(",", $matches[1]).']';
        $fgc = preg_replace("#<span class=\"comment\">// @q#", "<SPAN class=\"comment\" data=\"$questionIds\">// @q", $fgc);

        // Convert the comment with @q tags into a simple count
        $count = count($matches[1]);
        $fgc = preg_replace("#// @q.*?<#", "<span class=\"q-count\">$count</span><", $fgc);

        file_put_contents($filename, $fgc);
    }
}


