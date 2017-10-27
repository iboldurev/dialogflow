<?php

namespace DialogFlow\Model;

/**
 * Class QueryResult
 *
 * @package DialogFlow\Model
 */
class QueryResult extends Base
{
    /**
     * QueryResult constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!empty($data['contexts'])) {
            foreach ($data['contexts'] as $key => $context) {
                $data['contexts'][$key] = new Context($context);
            }
        }

        if (!empty($data['fulfillment'])) {
            $data['fulfillment'] = new Fulfillment($data['fulfillment']);
        }

        if (!empty($data['metadata'])) {
            $data['metadata'] = new Metadata($data['metadata']);
        }

        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return parent::get('source');
    }

    /**
     * @return string
     */
    public function getResolvedQuery()
    {
        return parent::get('resolvedQuery');
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return parent::get('action');
    }

    /**
     * @return bool
     */
    public function getActionIncomplete()
    {
        return parent::get('actionIncomplete');
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return parent::get('parameters', []);
    }

    /**
     * @return array|Context[]
     */
    public function getContexts()
    {
        return parent::get('contexts', []);
    }

    /**
     * @return Fulfillment
     */
    public function getFulfillment()
    {
        return parent::get('fulfillment');
    }

    /**
     * @return Metadata
     */
    public function getMetadata()
    {
        return parent::get('metadata');
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return parent::get('score');
    }

}
