<?php


namespace Liloy\Application\Error;


class ErrorResponser
{
        public static function getError($error, $context = 'Unknown error')
        {
            ErrorWriter::execute($context);
            http_response_code($error);
            exit;
        }
}