<h1>Let's Learn Bitcoin!</h1>
<h2>Annotated Bitcoin Source</h2>

<pre>
The Bitcoin source has been annotated with explanations. How does it work?

A fork of the Bitcoin repository with special comments is added such as:

In file src/addrman.h:

...some code here...    // @q1 @q2 @q3 @q4

This symbols @q1 means a question with index=1. All of the questions can be seen here: <a href='db.json'>db.json</a>
</pre>

A script will convert the <a href='html/'>Doxygen-generated documentation</a> and update the output so that you can
click on lines which are annotated, and explanations will appear in a side-panel.

<div>
Total annotated files: <?=$totalFiles?><br>
Total annotations: <?=$totalAnnotations?><br>
</div>

<h2>View Annotated Files</h2>

<ul>
<li>
<a href='html/addrman_8h_source.html'>html/addrman_8h_source.html</a>
</li>
</ul>

<br>

<img src="images/annotated.jpg">

<br>
The parser will detect 4 questions associated with the given line. If you click the line, the questions will appear on the right side.

<img src="images/linkedsource.jpg">

<br>

You can find all the source code on github <a href='https://github.com/thorie7912/bitcoin/tree/learn-bitcoin'>https://github.com/thorie7912/bitcoin/tree/learn-bitcoin</a>

