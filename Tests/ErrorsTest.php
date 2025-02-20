<?php

namespace Tests;

class ErrorsTest extends ImapTestCase
  {
  public function testFetchBodyBadMessageNumber() : void
	{
		$imap = @\imap_open($this->mailbox, $this->username, $this->accessToken, OP_SECURE);

		if ($imap)
			{
			$body = \imap_fetchbody($imap, 9999, null);
			$this->assertFalse($body);
			$this->assertFalse(\imap_last_error());
			}
		else
			$this->assertEquals("Can't open mailbox : no such mailbox", \imap_last_error());
	}

  public function testLastError1() : void
	{
		@\imap_open('...', '...', '...', OP_SECURE);
	$this->assertEquals('Can\'t open mailbox ...: no such mailbox', \imap_last_error());
	}

  public function testLastError2() : void
	{
		@\imap_open('{imap.gmail.com:993/imap/ssl}', 'wrong-username', 'wrong-password', OP_SECURE);
		$this->assertEquals('Can not authenticate to IMAP server: LOGIN: Invalid credentials (Failure)', \imap_last_error());
	}
	}
