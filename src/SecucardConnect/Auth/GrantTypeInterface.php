<?php

namespace SecucardConnect\Auth;

/**
 * Interface for auth request creation
 */
interface GrantTypeInterface
{
    /**
     * Function to return grant_type for current type
     *
     * @return string
     */
    public function getType();

    /**
     * Function to add parameters for authorization request
     *
     * @param array $params
     */
    public function addParameters(&$params);
}