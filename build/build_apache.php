<?php
include "scripts/cli_framework.php";

console_out("Website Build Utility\n");
console_out("=====================\n");
console_out("Unpacking Assets\n");

$archive = new ZipArchive();

$assets = $archive->open("bundles/assets.zip");

if ( $assets !== true )
{
    console_out("Error: could not find assets bundle.\n");
    exit;
}

$archive->extractTo("../");
$archive->close();

console_out("> Unpacked assets \n");
console_out("Copying htaccess \n");

copy("apache2/htaccess", "../../.htaccess");

console_out("> Copied htaccess\n");
console_out("Copying default database config file \n");

copy("config/connections/default.json", "./config/connections/default.json");

console_out("> Copied default database config file \n");
console_out("=====================\n");
console_out("Done!");