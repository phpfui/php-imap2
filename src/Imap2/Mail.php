<?php

/*
 * This file is part of the PHP IMAP2 package.
 *
 * (c) Francesco Bianco <bianco@PHPFUI.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPFUI\Imap2;

class Mail
	{
	/**
	 * Copy specified messages to a mailbox.
	 *
	 * @return false|mixed
	 */
	public static function copy(\IMAP\Connection $imap, $messageNums, string $mailbox, int $flags = 0)
		{
		if ($flags & CP_MOVE)
			{
			return Mail::move($imap, $messageNums, $mailbox, $flags);
			}

		$client = $imap->getClient();

		if (! ($flags & CP_UID))
			{
			$messageNums = \PHPFUI\Imap2\Message::idToUid($imap, $messageNums);
			}

		$from = $imap->getMailboxName();
		$to = $mailbox;

		return $client->copy($messageNums, $from, $to);
		}

	/**
	 * Move specified messages to a mailbox.
	 *
	 * @return false|mixed
	 */
	public static function move(\IMAP\Connection $imap, $messageNums, string $mailbox, int $flags = 0)
		{
		$client = $imap->getClient();
		//$client->setDebug(true);

		if (! ($flags & CP_UID))
			{
			$messageNums = \PHPFUI\Imap2\Message::idToUid($imap, $messageNums);
			}

		return $client->move($messageNums, $imap->getMailboxName(), $mailbox);
		}

	/**
	 * Send an email message.
	 *
	 * @return false|mixed
	 */
	public static function send(string $to, string $subject, string $message, $additionalHeaders = null, ?string $cc = null, ?string $bcc = null, ?string $returnPath = null)
		{
		$client = $imap->getClient();

		if (! ($options & ST_UID))
			{
			$messages = $client->fetch($imap->getMailboxName(), $sequence, false, ['UID']);

			$uid = [];

			foreach ($messages as $message)
				{
				$uid[] = $message->uid;
				}

			$sequence = \implode(',', $uid);
			}

		$client->flag($imap->getMailboxName(), $sequence, \strtoupper(\substr($flag, 1)));

		return false;
		}
	}
