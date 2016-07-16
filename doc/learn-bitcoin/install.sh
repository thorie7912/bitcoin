#!/bin/bash

set -x

ln -s ../../learn-bitcoin/learn-bitcoin.css ../doxygen/html/
ln -s ../../learn-bitcoin/learn-bitcoin.js ../doxygen/html/
ln -s ../../learn-bitcoin/get-questions ../doxygen/html/
ln -s ../learn-bitcoin/index.php ../doxygen/
ln -s ../learn-bitcoin/db.json ../doxygen/
ln -s ../learn-bitcoin/get-questions.php ../doxygen/
ln -s ../learn-bitcoin/images ../doxygen/
chgrp -R www-data ../doxygen/
