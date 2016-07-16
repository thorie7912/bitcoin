<?php
// This script converts source files into special @q annotated output files.

foreach (glob("../doxygen/html/*_source.html") as $filename) {
    //echo "Checking $filename\n";
    $fgc = file_get_contents($filename);

    $i = 0;

    do { 
      $ret = preg_match('#// (@q.*?)<#', $fgc, $matches);
      if (!empty($matches[1])) {
        preg_match_all('#@q([\d]+)#', $matches[1], $idmatches);
        $ids = $idmatches[1];
        echo "$filename: " . implode(', ', $ids) . "\n";

        // Convert question #'s into element data
        $questionIds = '['.implode(",", $ids).']';
        $fgc = preg_replace("#// @q(.*?)<#", "<span class=\"q-comment\" data=\"$questionIds\">// @q$1<", $fgc, 1, $count);
        if ($count !== 1) {
            throw new \Exception('Bad replace' . $count);
        }

        // Convert the comment with @q tags into a simple count
        $count = count($ids);
        $fgc = preg_replace("#// @q.*?<#", "<span class=\"q-count\">$count</span><", $fgc, 1);
      } 
    } while ($ret);

    // Add css
    $fgc = preg_replace("#(</head>)#", "<link href=\"learn-bitcoin.css\" rel=\"stylesheet\" type=\"text/css\" />\n$1", $fgc);

    // Add left and right panes
    $fgc = preg_replace("#(<div class=\"fragment\">)#", "<div class=\"left-pane\">$1", $fgc);
    $fgc = preg_replace("#(</div><!-- fragment -->)#", "$1</div><!-- left-pane --><div class=\"right-pane\"></div><!-- right-pane -->", $fgc);

    // Add js
    $fgc = preg_replace("#(</body>)#", "<script src=\"learn-bitcoin.js\"></script>\n$1", $fgc);

    file_put_contents($filename, $fgc);
}


