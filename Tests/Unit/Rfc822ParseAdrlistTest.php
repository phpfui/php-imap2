<?php

namespace Tests\Unit;

class Rfc822ParseAdrlistTest extends \PHPUnit\Framework\TestCase
	{
	public function test_rfc822_parse_adrlist() : void
		{
		$address_string = 'Joe Doe <doe@example.com>, postmaster@example.com, root';
		$address_array = \imap_rfc822_parse_adrlist($address_string, 'example.com');

		$this->assertIsArray($address_array);

		$this->assertEquals('doe', $address_array[0]->mailbox);
		$this->assertEquals('example.com', $address_array[0]->host);
		$this->assertEquals('Joe Doe', $address_array[0]->personal);

		$this->assertEquals('postmaster', $address_array[1]->mailbox);
		$this->assertEquals('example.com', $address_array[1]->host);

		$this->assertEquals('root', $address_array[2]->mailbox);
		$this->assertEquals('example.com', $address_array[2]->host);
		}
	}
