<?php

namespace SecucardConnect\Client;


/**
 * Class MissingParamsError
 */
class MissingParamsError extends ApiError
{
    /**
     * @param string $parameter
     * @param string $function
     */
    public function __construct(
        $parameter,
        $function
    ) {
        $msg = 'Missing Params Error: parameter=' . $parameter . ', function=' . $function;
        parent::__construct($msg, 0, '', '', '');
        $this->message = $msg;
    }

}
