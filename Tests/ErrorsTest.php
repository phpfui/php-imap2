<?php

namespace Tests;

class ErrorsTest extends ImapTestCase
  {
  public function testLastError1()
    {
		$this->expectException(\ValueError::class);
    $this->expectExceptionMessage('imap_open(): Couldn\'t open stream ... in ' . __FILE__ . ' on line ' . (__LINE__ + 1) . '. Source code');
		imap_open('...', '...', '...', OP_XOAUTH2);
    $this->assertEquals('Can\'t open mailbox ...: no such mailbox', imap_last_error());
    }

  public function testLastError2()
    {
    $this->expectExceptionMessage('imap_open(): Couldn\'t open stream {imap.gmail.com:993/imap/ssl} in '.__FILE__.' on line '.(__LINE__ + 1));
		imap_open('{imap.gmail.com:993/imap/ssl}', 'wrong-username', 'wrong-password', OP_XOAUTH2);
		$this->assertEquals('Can not authenticate to IMAP server: A0001 NO [AUTHENTICATIONFAILED] Invalid credentials (Failure)', imap_last_error());
    }

  public function testFetchBodyBadMessageNumber()
    {
//		$this->expectExceptionMessage('imap_fetchbody(): Bad message number in '.__FILE__.' on line '.(__LINE__ + 2));
		$imap = imap_open($this->mailbox, $this->username, $this->accessToken, OP_XOAUTH2);
		if ($imap)
			{
			$body = imap_fetchbody($imap, 9999, null);
			$this->assertFalse($body);
			}
		$this->assertFalse(imap_last_error());
    }
	}
