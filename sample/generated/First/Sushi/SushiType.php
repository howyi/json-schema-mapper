<?php

namespace Json\First\Sushi;

use Eloquent\Enumeration\AbstractEnumeration;

class SushiType extends AbstractEnumeration
{
    public const NETA = 'ネタ';
    public const SHARI = 'シャリ';
}
