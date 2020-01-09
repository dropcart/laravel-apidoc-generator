<?php

namespace Mpociot\ApiDoc\Extracting\Strategies\UrlParameters;

use Mpociot\ApiDoc\Extracting\Strategies\BodyParameters\GetFromBodyParamTag;

class GetFromUrlParamTagIncludingType extends GetFromBodyParamTag
{
    protected $tagName = 'urlParam';
}
