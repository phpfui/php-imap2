<?php

namespace Tests\Unit;

class Rfc822WriteAddressTest extends \PHPUnit\Framework\TestCase
	{
	public function test_rfc822_write_address() : void
		{
		$address = imap_rfc822_write_address("hartmut", "example.com", "Hartmut Holzgraefe");
		$this->assertEquals($address, 'Hartmut Holzgraefe <hartmut@example.com>');

		$address = imap_rfc822_write_address("hartmut", "example.com", '');
		$this->assertEquals($address, 'hartmut@example.com');

		$address = imap_rfc822_write_address("hartmut@example.com", '', '');
		$this->assertEquals($address, 'hartmut@example.com');
		}
	}
