<?php

namespace Tests;

use PHPFUI\Imap2\Connection;
use PHPFUI\Imap2\Functions;
use PHPFUI\Imap2\HeaderInfo;

class HeaderInfoTest extends ImapTestCase
{
    public function testSanitizeAddress()
    {
        $inputs = [
            '"TeamViewer Sign In Confirmation" <SignIn-noreply@teamviewer.com>' => 'TeamViewer Sign In Confirmation <SignIn-noreply@teamviewer.com>',
            '"Aruba.it" <newsletter@staff.aruba.it>' => 'Aruba.it <newsletter@staff.aruba.it>',
        ];

        foreach ($inputs as $input => $output) {
            $this->assertEquals($output, Functions::sanitizeAddress($input, 'localhost'));
        }
    }
}
