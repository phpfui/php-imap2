<?php

namespace Tests\Unit;

class Rfc822WriteAddressTest extends \PHPUnit\Framework\TestCase
	{
	public function test_rfc822_write_address() : void
		{
		$address = \imap_rfc822_write_address('hartmut', 'example.com', 'Hartmut Holzgraefe');
		$this->assertEquals('Hartmut Holzgraefe <hartmut@example.com>', $address);

		$address = \imap_rfc822_write_address('hartmut', 'example.com', '');
		$this->assertEquals('hartmut@example.com', $address);
		}
	}
