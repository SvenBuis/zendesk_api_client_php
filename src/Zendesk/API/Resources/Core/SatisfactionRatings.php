<?php

namespace Zendesk\API\Resources\Core;

use Zendesk\API\Resources\ResourceAbstract;
use Zendesk\API\Traits\Resource\Create;
use Zendesk\API\Traits\Resource\Find;
use Zendesk\API\Traits\Resource\FindAll;

/**
 * Class Satisfaction Ratings
 * https://developer.zendesk.com/rest_api/docs/core/satisfaction_ratings
 */
class SatisfactionRatings extends ResourceAbstract
{
    use Create;
    use Find;
    use FindAll;
}
