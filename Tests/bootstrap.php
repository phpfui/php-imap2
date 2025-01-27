<?php

\error_reporting(E_ALL);

// allow the autoloader to be included from any script that needs it.
function autoload(string $className) : void
	{
	$path = \str_replace('\\', DIRECTORY_SEPARATOR, __DIR__ . "/../{$className}.php");

	@include_once $path;
	}

include __DIR__ . '//..//vendor//autoload.php';

include __DIR__ . '//..//src//Imap2//IMAPStubs.php';
