<?php

use Javanile\Imap2\Connection;
use Javanile\Imap2\Errors;
use Javanile\Imap2\Mail;
use Javanile\Imap2\Mailbox;
use Javanile\Imap2\Message;
use Javanile\Imap2\Thread;
use Javanile\Imap2\Polyfill;
use Javanile\Imap2\Timeout;
use Javanile\Imap2\Functions;

define('IMAP2_CHARSET', 'UTF-8');
define('IMAP2_RETROFIT_MODE', function_exists('imap_open'));

if (!defined('NIL')) {
    define('NIL', 0);
}
if (!defined('OP_DEBUG')) {
    define('OP_DEBUG', 1);
}
if (!defined('OP_READONLY')) {
    define('OP_READONLY', 2);
}
if (!defined('OP_ANONYMOUS')) {
    define('OP_ANONYMOUS', 4);
}
if (!defined('OP_SHORTCACHE')) {
    define('OP_SHORTCACHE', 8);
}
if (!defined('OP_SILENT')) {
    define('OP_SILENT', 16);
}
if (!defined('OP_PROTOTYPE')) {
    define('OP_PROTOTYPE', 32);
}
if (!defined('OP_HALFOPEN')) {
    define('OP_HALFOPEN', 64);
}
if (!defined('OP_EXPUNGE')) {
    define('OP_EXPUNGE', 128);
}
if (!defined('OP_SECURE')) {
    define('OP_SECURE', 256);
}
if (!defined('OP_XOAUTH2')) {
    define('OP_XOAUTH2', 512);
}
if (!defined('CL_EXPUNGE')) {
    define('CL_EXPUNGE', 32768);
}
if (!defined('FT_UID')) {
    define('FT_UID', 1);
}
if (!defined('FT_PEEK')) {
    define('FT_PEEK', 2);
}
if (!defined('FT_NOT')) {
    define('FT_NOT', 4);
}
if (!defined('FT_INTERNAL')) {
    define('FT_INTERNAL', 8);
}
if (!defined('FT_PREFETCHTEXT')) {
    define('FT_PREFETCHTEXT', 32);
}
if (!defined('ST_UID')) {
    define('ST_UID', 1);
}
if (!defined('ST_SILENT')) {
    define('ST_SILENT', 2);
}
if (!defined('ST_SET')) {
    define('ST_SET', 4);
}
if (!defined('CP_UID')) {
    define('CP_UID', 1);
}
if (!defined('CP_MOVE')) {
    define('CP_MOVE', 2);
}
if (!defined('SE_UID')) {
    define('SE_UID', 1);
}
if (!defined('SE_FREE')) {
    define('SE_FREE', 2);
}
if (!defined('SE_NOPREFETCH')) {
    define('SE_NOPREFETCH', 4);
}
if (!defined('SO_FREE')) {
    define('SO_FREE', 8);
}
if (!defined('SO_NOSERVER')) {
    define('SO_NOSERVER', 16);
}
if (!defined('SA_MESSAGES')) {
    define('SA_MESSAGES', 1);
}
if (!defined('SA_RECENT')) {
    define('SA_RECENT', 2);
}
if (!defined('SA_UNSEEN')) {
    define('SA_UNSEEN', 4);
}
if (!defined('SA_UIDNEXT')) {
    define('SA_UIDNEXT', 8);
}
if (!defined('SA_UIDVALIDITY')) {
    define('SA_UIDVALIDITY', 16);
}
if (!defined('SA_ALL')) {
    define('SA_ALL', 31);
}
if (!defined('LATT_NOINFERIORS')) {
    define('LATT_NOINFERIORS', 1);
}
if (!defined('LATT_NOSELECT')) {
    define('LATT_NOSELECT', 2);
}
if (!defined('LATT_MARKED')) {
    define('LATT_MARKED', 4);
}
if (!defined('LATT_UNMARKED')) {
    define('LATT_UNMARKED', 8);
}
if (!defined('LATT_REFERRAL')) {
    define('LATT_REFERRAL', 16);
}
if (!defined('LATT_HASCHILDREN')) {
    define('LATT_HASCHILDREN', 32);
}
if (!defined('LATT_HASNOCHILDREN')) {
    define('LATT_HASNOCHILDREN', 64);
}
if (!defined('SORTDATE')) {
    define('SORTDATE', 0);
}
if (!defined('SORTARRIVAL')) {
    define('SORTARRIVAL', 1);
}
if (!defined('SORTFROM')) {
    define('SORTFROM', 2);
}
if (!defined('SORTSUBJECT')) {
    define('SORTSUBJECT', 3);
}
if (!defined('SORTTO')) {
    define('SORTTO', 4);
}
if (!defined('SORTCC')) {
    define('SORTCC', 5);
}
if (!defined('SORTSIZE')) {
    define('SORTSIZE', 6);
}
if (!defined('TYPETEXT')) {
    define('TYPETEXT', 0);
}
if (!defined('TYPEMULTIPART')) {
    define('TYPEMULTIPART', 1);
}
if (!defined('TYPEMESSAGE')) {
    define('TYPEMESSAGE', 2);
}
if (!defined('TYPEAPPLICATION')) {
    define('TYPEAPPLICATION', 3);
}
if (!defined('TYPEAUDIO')) {
    define('TYPEAUDIO', 4);
}
if (!defined('TYPEIMAGE')) {
    define('TYPEIMAGE', 5);
}
if (!defined('TYPEVIDEO')) {
    define('TYPEVIDEO', 6);
}
if (!defined('TYPEMODEL')) {
    define('TYPEMODEL', 7);
}
if (!defined('TYPEOTHER')) {
    define('TYPEOTHER', 8);
}
if (!defined('ENC7BIT')) {
    define('ENC7BIT', 0);
}
if (!defined('ENC8BIT')) {
    define('ENC8BIT', 1);
}
if (!defined('ENCBINARY')) {
    define('ENCBINARY', 2);
}
if (!defined('ENCBASE64')) {
    define('ENCBASE64', 3);
}
if (!defined('ENCQUOTEDPRINTABLE')) {
    define('ENCQUOTEDPRINTABLE', 4);
}
if (!defined('ENCOTHER')) {
    define('ENCOTHER', 5);
}
if (!defined('IMAP_OPENTIMEOUT')) {
    define('IMAP_OPENTIMEOUT', 1);
}
if (!defined('IMAP_READTIMEOUT')) {
    define('IMAP_READTIMEOUT', 2);
}
if (!defined('IMAP_WRITETIMEOUT')) {
    define('IMAP_WRITETIMEOUT', 3);
}
if (!defined('IMAP_CLOSETIMEOUT')) {
    define('IMAP_CLOSETIMEOUT', 4);
}
if (!defined('IMAP_GC_ELT')) {
    define('IMAP_GC_ELT', 1);
}
if (!defined('IMAP_GC_ENV')) {
    define('IMAP_GC_ENV', 2);
}
if (!defined('IMAP_GC_TEXTS')) {
    define('IMAP_GC_TEXTS', 4);
}

if (!function_exists('imap_open'))
  {
  function imap_open(string $mailbox, string $user, string $password, int $flags = 0, int $retries = 0, array $options = []) : Connection|false
    {
    return Connection::open($mailbox, $user, $password, $flags, $retries, $options);
    }
  }

if (!function_exists('imap_reopen'))
  {
  function imap_reopen(Connection $imap, string $mailbox, int $flags = 0, int $retries = 0) : bool
    {
    return Connection::reopen($imap, $mailbox, $flags, $retries);
    }
  }

if (!function_exists('imap_ping'))
  {
  function imap_ping(Connection $imap) : bool
    {
    return Connection::ping($imap);
    }
  }

if (!function_exists('imap_close'))
  {
  function imap_close($imap, int $flags = 0) : true
    {
    return Connection::close($imap, $flags);
    }
  }

if (!function_exists('imap_timeout'))
  {
  function imap_timeout(int $timeout_type, int $timeout = -1): int|bool
    {
    return Timeout::set($timeoutType, $timeout);
    }
  }

if (!function_exists('imap_check'))
  {
  function imap_check(Connection $imap) : stdClass|false
    {
    return Mailbox::check($imap);
    }
  }

if (!function_exists('imap_status'))
  {
  function imap_status($imap,  string $mailbox, int $flags): stdClass|false
    {
    return Mailbox::status($imap, $mailbox, $flags);
    }
  }

if (!function_exists('imap_num_msg'))
  {
  function imap_num_msg(Connection $imap) : int|false
    {
    return Mailbox::numMsg($imap);
    }
  }

if (!function_exists('imap_num_recent'))
  {
  function imap_num_recent($imap) : int
    {
    return Mailbox::numRecent($imap);
    }
  }

if (!function_exists('imap_list'))
  {
  function imap_list(Connection $imap, string $reference, string $pattern): array|false
    {
    return Mailbox::list($imap, $reference, $pattern);
    }
  }

if (!function_exists('imap_listmailbox'))
  {
  function imap_listmailbox($imap, string $reference, string $pattern): array|false
    {
    return Mailbox::list($imap, $reference, $pattern);
    }
  }

if (!function_exists('imap_listscan'))
  {
  function imap_listscan(Connection $imap, string $reference, string $pattern, string $content): array|false
    {
    return Mailbox::listScan($imap, $reference, $pattern, $content);
    }


if (!function_exists('imap_scan'))
  {
  function imap_scan($imap, string $reference, string $pattern, string $content): array|false
    {
    return Mailbox::listScan($imap, $reference, $pattern, $content);
    }
  }

if (!function_exists('imap_scanmailbox'))
  {
  function imap_scanmailbox(Connection $imap, string $reference, string $pattern, string $content): array|false
    {
    return Mailbox::listScan($imap, $reference, $pattern, $content);
    }
  }

if (!function_exists('imap_getmailboxes'))
  {
  function imap_getmailboxes($imap, string $reference, string $pattern): array|false
    {
    return Mailbox::getMailboxes($imap, $reference, $pattern);
    }
  }

if (!function_exists('imap_listsubscribed'))
  {
  function imap_listsubscribed(Connection $imap, string $reference, string $pattern): array|false
    {
    return Mailbox::listSubscribed($imap, $reference, $pattern);
    }
  }

if (!function_exists('imap_lsub'))
  {
  function imap_lsub($imap, string $reference, string $pattern): array|false
    {
    return Mailbox::listSubscribed($imap, $reference, $pattern);
    }
  }

if (!function_exists('imap_getsubscribed'))
  {
  function imap_getsubscribed(Connection $imap, string $reference, string $pattern): array|false
    {
    return Mailbox::getSubscribed($imap, $reference, $pattern);
    }
  }

if (!function_exists('imap_subscribe'))
  {
  function imap_subscribe(Connection $imap,  string $mailbox): bool
    {
    return Mailbox::subscribe($imap, $mailbox);
    }
  }

if (!function_exists('imap_unsubscribe'))
  {
  function imap_unsubscribe(Connection $imap,  string $mailbox): bool
    {
    return Mailbox::unsubscribe($imap, $mailbox);
    }
  }

if (!function_exists('imap_createmailbox'))
  {
  function imap_createmailbox(Connection $imap,  string $mailbox): bool
    {
    return Mailbox::createMailbox($imap, $mailbox);
    }
  }

if (!function_exists('imap_create'))
  {
  function imap_create(Connection $imap, string $mailbox): bool
    {
    return Mailbox::createMailbox($imap, $mailbox);
    }
  }

if (!function_exists('imap_deletemailbox'))
  {
  function imap_deletemailbox(Connection $imap, string $mailbox): bool
    {
    return Mailbox::deleteMailbox($imap, $mailbox);
    }
  }

if (!function_exists('imap_renamemailbox'))
  {
  function imap_renamemailbox(Connection $imap, string $from, string $to): bool
    {
    return Mailbox::renameMailbox($imap, $from, $to);
    }
  }

if (!function_exists('imap_rename'))
  {
  function imap_rename(Connection $imap,  string $from, string $to): bool
    {
    return Mailbox::renameMailbox($imap, $from, $to);
    }
  }

if (!function_exists('imap_mailboxmsginfo'))
  {
  function imap_mailboxmsginfo(Connection $imap): stdclass
    {
    return Mailbox::mailboxMsgInfo($imap);
    }
  }

if (!function_exists('imap_search'))
  {
  function imap_search(Connection $imap, string $criteria, int $flags = SE_FREE, string $charset = ""): array|false
    {
    return Message::search($imap, $criteria, $flags, $charset);
    }
  }

if (!function_exists('imap_headers'))
  {
  function imap_headers(Connection $imap) : array|false
    {
    return Message::headers($imap);
    }
  }

if (!function_exists('imap_msgno'))
  {
  function imap_msgno(Connection $imap, int $message_uid): int
    {
    return Message::msgNo($imap, $message_uid);
    }
  }

if (!function_exists('imap_uid'))
  {
  function imap_uid(Connection $imap, int $message_num): int|false
    {
    return Message::uid($imap, $message_num);
    }
  }

if (!function_exists('imap_sort'))
  {
  function imap_sort(Connection $imap, int $criteria, bool $reverse, int $flags = 0, ?string $search_criteria = null, ?string $charset = null): array|false
    {
    return Message::sort($imap, $criteria, $reverse, $flags, $searchCriteria, $charset);
    }
  }

if (!function_exists('imap_append'))
  {
  function imap_append(Connection $imap,string $folder, string $message, ?string $options = null, ?string $internal_date = null): bool
    {
    return Mailbox::append($imap, $folder, $message, $options, $internalDate);
    }
  }

if (!function_exists('imap_headerinfo'))
  {
  function imap_headerinfo(Connection $imap,int $message_num, int $from_length = 0, int $subject_length = 0): stdClass|false
    {
    return Message::headerInfo($imap, $message_num, $from_length, $subject_length);
    }
  }

if (!function_exists('imap_header'))
  {
  function imap_header(Connection $imap, int $message_num, int $from_length = 0, int $subject_length = 0): stdClass|false
    {
    return Message::headerInfo($imap, $message_num, $from_length, $subject_length);
    }
  }

if (!function_exists('imap_body'))
  {
  function imap_body(Connection $imap, int $message_num, int $flags = 0): string|false
    {
    return Message::body($imap, $message_num, $flags);
    }
  }

if (!function_exists('imap_fetchtext'))
  {
  function imap_fetchtext(Connection $imap, int $message_num, int $flags = 0): string|false
    {
    return Message::body($imap, $message_num, $flags);
    }
  }

if (!function_exists('imap_fetchbody'))
  {
  function imap_fetchbody(Connection $imap,int $message_num, string $section, int $flags = 0): string|false
    {
    return Message::fetchBody($imap, $message_num, $section, $flags);
    }
  }

if (!function_exists('imap_bodystruct'))
  {
  function imap_bodystruct(Connection $imap, int $message_num, string $section): stdClass|false
    {
    return Message::bodyStruct($imap, $message_num, $section);
    }
  }

if (!function_exists('imap_savebody'))
  {
  function imap_savebody(Connection $imap, \resource|string|int $file, int $message_num, string $section = "", int $flags = 0): bool
    {
    return Message::saveBody($imap, $file, $message_num, $section, $flags);
    }
  }

if (!function_exists('imap_fetchstructure'))
  {
  function imap_fetchstructure(Connection $imap, int $message_num, int $flags = 0): stdClass|false
    {
    return Message::fetchStructure($imap, $message_num, $flags);
    }
  }

if (!function_exists('imap_fetchheader'))
  {
  function imap_fetchheader(Connection $imap,int $message_num, int $flags = 0): string|false
    {
    return Message::fetchHeader($imap, $message_num, $flags);
    }
  }

if (!function_exists('imap_fetch_overview'))
  {
  function imap_fetch_overview(Connection $imap, string $sequence, int $flags = 0): array|false
    {
    return Message::fetchOverview($imap, $sequence, $flags);
    }
  }

if (!function_exists('imap_fetchmime'))
  {
  function imap_fetchmime(Connection $imap, int $message_num, string $section, int $flags = 0): string|false
    {
    return Message::fetchMime($imap, $message_num, $section, $flags);
    }
  }

if (!function_exists('imap_delete'))
  {
  function imap_delete(Connection $imap,  string $message_nums, int $flags = 0): true
    {
    return Message::delete($imap, $message_nums, $flags);
    }
  }

if (!function_exists('imap_undelete'))
  {
  function imap_undelete(Connection $imap,string $message_nums, int $flags = 0): true
    {
    return Message::undelete($imap, $message_nums, $flags);
    }
  }

if (!function_exists('imap_clearflag_full'))
  {
  function imap_clearflag_full(Connection $imap, string $sequence, string $flag, int $options = 0): true
    {
    return Message::undelete($imap, $message_nums, $flags);
    }
  }

if (!function_exists('imap_setflag_full'))
  {
  function imap_setflag_full(Connection $imap,string $sequence, string $flag, int $options = 0): true
    {
    return Message::setFlagFull($imap, $sequence, $flag, $options);
    }
  }

if (!function_exists('imap_mail_compose'))
  {
  function imap_mail_compose(array $envelope, array $bodies): string|false
    {
    return Polyfill::mailCompose($envelope, $bodies);
    }
  }

if (!function_exists('imap_mail_copy'))
  {
  function imap_mail_copy(Connection $imap, string $message_nums, string $mailbox, int $flags = 0): bool
    {
    return Mail::copy($imap, $message_nums, $mailbox, $flags);
    }
  }

if (!function_exists('imap_mail_move'))
  {
  function imap_mail_move(Connection $imap, string $message_nums, string $mailbox, int $flags = 0): bool
    {
    return Mail::move($imap, $message_nums, $mailbox, $flags);
    }
  }

if (!function_exists('imap_mail'))
  {
  function imap_mail(string $to, string $subject, string $message, ?string $additional_headers = null, ?string $cc = null, ?string $bcc = null, ?string $return_path = null): bool
    {
    return Mail::send($to, $subject, $message, $additionalHeaders, $cc, $bcc, $returnPath);
    }
  }

if (!function_exists('imap_expunge'))
  {
  function imap_expunge(Connection $imap) : true
    {
    return Message::expunge($imap);
    }
  }

if (!function_exists('imap_gc'))
  {
  function imap_gc(Connection $imap, int $flags) : true
    {
    return Message::expunge($imap, $flags);
    }
  }

if (!function_exists('imap_get_quota'))
  {
  function imap_get_quota(Connection $imap, $quotaRoot)
    {
    throw new \Exception(__FUNCTION__ . ' is not implemented.');
    }
  }

if (!function_exists('imap_set_quota'))
  {
  function imap_set_quota(Connection $imap,string $quota_root): array|false
    {
    throw new \Exception(__FUNCTION__ . ' is not implemented.');
    }
  }

if (!function_exists('imap_get_quotaroot'))
  {
  function imap_get_quotaroot(Connection $imap, $mailbox)
    {
    throw new \Exception(__FUNCTION__ . ' is not implemented.');
    }
  }

if (!function_exists('imap_getacl'))
  {
  function imap_getacl(Connection $imap, $mailbox)
    {
    throw new \Exception(__FUNCTION__ . ' is not implemented.');
    }
  }

if (!function_exists('imap_setacl'))
  {
  Function imap_setacl(Connection $imap, $mailbox, $userId, $rights)
    {
    throw new \Exception(__FUNCTION__ . ' is not implemented.');
    }
  }

if (!function_exists('imap_thread'))
  {
  function imap_thread(Connection $imap, int $flags = SE_FREE): array|false
    {
    return Thread::thread($imap, $flags);
    }
  }

if (!function_exists('imap_errors'))
  {
  function imap_errors() : array|false
    {
    return Errors::errors();
    }
  }

if (!function_exists('imap_last_error'))
  {
  function imap_last_error() : string|false
    {
    return Errors::lastError();
    }
  }

if (!function_exists('imap_alerts'))
  {
  function imap_alerts() : array|false
    {
    return Errors::alerts();
    }
  }

if (!function_exists('imap_8bit'))
  {
  function imap_8bit(string $string) : string|false
    {
    return Polyfill::convert8bit($string);
    }
  }

if (!function_exists('imap_base64'))
  {
  function imap_base64(string $string) : string|false
    {
    return base64_decode($string, true);
    }
  }

if (!function_exists('imap_binary'))
  {
  function imap_binary(string $string): string|false
    {
    return base64_encode($string);
    }
  }

if (!function_exists('imap_mime_header_decode'))
  {
  function imap_mime_header_decode(string $string): array|false
    {
    return Polyfill::mimeHeaderDecode($string);
    }
  }

if (!function_exists('imap_mutf7_to_utf8'))
  {
  function imap_mutf7_to_utf8(string $string): string|false
    {
    return Polyfill::mutf7ToUtf8($string);
    }
  }

if (!function_exists('imap_qprint'))
  {
  function imap_qprint(string $string): string|false
    {
    return Polyfill::qPrint($string);
    }
  }

if (!function_exists('imap_rfc822_parse_adrlist'))
  {
  function imap_rfc822_parse_adrlist(string $string, string $default_hostname): array
    {
    return Polyfill::rfc822ParseAdrList($string, $defaultHostname);
    }
  }

if (!function_exists('imap_rfc822_parse_headers'))
  {
  function imap_rfc822_parse_headers(string $headers, string $default_hostname = "UNKNOWN"): stdClass
    {
    return Polyfill::rfc822ParseHeaders($headers, $defaultHostname);
    }
  }

if (!function_exists('imap_rfc822_write_address'))
  {
  function imap_rfc822_write_address(string $mailbox, string $hostname, string $personal): string|false
    {
    return Polyfill::rfc822WriteHeaders($mailbox, $hostname, $personal);
    }
  }

if (!function_exists('imap_utf7_decode'))
  {
  function imap_utf7_decode(string $string) : string|false
    {
    return Polyfill::utf7Decode($string);
    }
  }

if (!function_exists('imap_utf7_encode'))
  {
  function imap_utf7_encode(string $string) : string
    {
    return Polyfill::utf7Encode($string);
    }
  }

if (!function_exists('imap_utf8_to_mutf7'))
  {
  function imap_utf8_to_mutf7(string $string) : string
    {
    return Polyfill::utf8ToMutf7($string);
    }
	}

if (!function_exists('imap_utf8'))
	{
  function imap_utf8(string $string) : string
    {
		return Polyfill::utf8($string);
    }
	}
