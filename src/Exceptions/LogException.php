<?php

namespace Wladweb\Phpconsole\Exceptions;

/**
 * This exception thrown in any controller doesn't stop application
 * It just write code & message in log file
 * Could be useful for huge|complicated loops if u dont want to break loop,
 * but want to know what happened there
 */
class LogException extends \Exception
{
    //
}
