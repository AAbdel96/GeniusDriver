<?php

$parts = explode('@',"johndoe@example.com");

$user = $parts[0];
// Stick the @ back onto the domain since it was chopped off.
$domain = $parts[0];



