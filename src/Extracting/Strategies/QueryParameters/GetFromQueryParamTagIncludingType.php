<?php

namespace Mpociot\ApiDoc\Extracting\Strategies\QueryParameters;

use Mpociot\ApiDoc\Extracting\Strategies\BodyParameters\GetFromBodyParamTag;

class GetFromQueryParamTagIncludingType extends GetFromBodyParamTag
{
    protected $tagName = 'queryParam';
}
