<?php

namespace Tests;

use PHPFUI\Imap2\Functions;

class HeaderInfoTest extends ImapTestCase
  {
  public function testSanitizeAddress() : void
	{
	$inputs = [
		'"TeamViewer Sign In Confirmation" <SignIn-noreply@teamviewer.com>' => 'TeamViewer Sign In Confirmation <SignIn-noreply@teamviewer.com>',
		'"Aruba.it" <newsletter@staff.aruba.it>' => 'Aruba.it <newsletter@staff.aruba.it>',
		'Aruba.it <newsletter@staff.aruba.it>' => 'Aruba.it <newsletter@staff.aruba.it>',
		"'Aruba.it' <newsletter@staff.aruba.it>" => "'Aruba.it' <newsletter@staff.aruba.it>",
		"Aruba'i <newsletter@staff.aruba.it>" => "Aruba'i <newsletter@staff.aruba.it>",
	];

		foreach ($inputs as $input => $output)
			{
	  $this->assertEquals($output, Functions::sanitizeAddress($input, 'localhost'));
			}
	}
	}
