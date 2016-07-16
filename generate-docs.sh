#!/bin/bash

../doxygen/build/bin/doxygen doc/Doxyfile

cd doc/learn-bitcoin
php convert.php
