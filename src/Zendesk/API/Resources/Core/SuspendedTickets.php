<?php

namespace Zendesk\API\Resources\Core;

use Zendesk\API\Exceptions\MissingParametersException;
use Zendesk\API\Http;
use Zendesk\API\Resources\ResourceAbstract;
use Zendesk\API\Traits\Resource\Delete;
use Zendesk\API\Traits\Resource\DeleteMany;
use Zendesk\API\Traits\Resource\Find;
use Zendesk\API\Traits\Resource\FindAll;

/**
 * The SuspendedTickets class exposes view management methods
 */
class SuspendedTickets extends ResourceAbstract
{
    use Find;
    use FindAll;
    use Delete;

    use DeleteMany;

    /**
     * {@inheritdoc}
     */
    protected function setUpRoutes()
    {
        $this->setRoutes([
            'recover'     => "{$this->resourceName}/{id}/recover.json",
            'recoverMany' => "{$this->resourceName}/recover_many.json",
        ]);
    }

    /**
     * Recovering suspended tickets.
     *
     * @param $id
     *
     * @return mixed
     * @throws MissingParametersException
     */
    public function recover($id = null)
    {
        if (empty($id)) {
            $id = $this->getChainedParameter(self::class);
        }

        if (empty($id)) {
            throw new MissingParametersException(__METHOD__, ['id']);
        }

        return $this->client->put($this->getRoute(__FUNCTION__, ['id' => $id]));
    }

    /**
     * Recovering suspended tickets.
     *
     * @param array $ids
     *
     * @return mixed
     * @throws MissingParametersException
     * @throws \Zendesk\API\Exceptions\ApiResponseException
     * @throws \Zendesk\API\Exceptions\RouteException
     *
     */
    public function recoverMany(array $ids)
    {
        if (! is_array($ids)) {
            throw new MissingParametersException(__METHOD__, ['ids']);
        }

        $response = Http::send(
            $this->client,
            $this->getRoute(__FUNCTION__),
            [
                'method'      => 'PUT',
                'queryParams' => ['ids' => implode(',', $ids)],
            ]
        );

        return $response;
    }
}