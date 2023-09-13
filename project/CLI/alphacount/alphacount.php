#!/usr/bin/env php
<?php

// Check if the user provided an input sentence
if ($argc != 2) {
    echo "Usage: alphacount \"<sentence>\"\n";
    exit(1);
}

// Get the input sentence from the command line argument
$sentence = $argv[1];

// Remove non-alphabet characters and count the remaining characters
$alphabetsCount = preg_match_all('/[a-zA-Z!1-9]/', $sentence, $matches);

if ($alphabetsCount === false) {
    echo "Error occurred while counting alphabets.\n";
    exit(1);
}

echo "Total alphabets/characters: $alphabetsCount\n";