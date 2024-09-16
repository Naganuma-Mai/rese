<?php

namespace App\Contracts;

interface CreatesNewRepresentatives
{
    /**
     * Validate and create a newly registered representative.
     *
     * @param  array  $input
     * @return \App\Models\Representative
     */
    public function create(array $input);
}
