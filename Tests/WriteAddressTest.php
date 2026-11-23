<?php

namespace Tests;

/**
 * Envelope addresses use NIL (null) for a missing display name or host, which threw a TypeError
 */
class WriteAddressTest extends \PHPUnit\Framework\TestCase
	{
	protected function setUp() : void
		{
		if (\extension_loaded('imap'))
			{
			$this->markTestSkipped('ext-imap is loaded, so the library\'s imap_rfc822_write_address() is not used');
			}
		}

	public function testNullArguments() : void
		{
		$this->assertEquals('john@example.com', \imap_rfc822_write_address('john', 'example.com', null));
		$this->assertEquals('john', \imap_rfc822_write_address('john', null, null));
		$this->assertEquals('', \imap_rfc822_write_address(null, null, null));
		}

	public function testEnvelopeWithoutDisplayName() : void
		{
		// envelope address entries are [personal, route, mailbox, host]
		$this->assertEquals('bob@example.com', \PHPFUI\Imap2\Functions::writeAddressFromEnvelope([[null, null, 'bob', 'example.com']]));
		$this->assertEquals('Bob <bob@example.com>', \PHPFUI\Imap2\Functions::writeAddressFromEnvelope([['Bob', null, 'bob', 'example.com']]));
		$this->assertEquals('', \PHPFUI\Imap2\Functions::writeAddressFromEnvelope([]));
		}
	}
