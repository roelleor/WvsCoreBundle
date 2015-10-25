<?php

namespace Wvs\CoreBundle\Helper;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

class EntityHelper
{

    const PROPERTY_FORMAT_CAMElCASE = 'PROPERTY_FORMAT_CAMElCASE';
    const PROPERTY_FORMAT_UNDERSCORE = 'PROPERTY_FORMAT_UNDERSCORE';

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    function __construct($serializer)
    {
        $this->serializer = $serializer;
    }

    public function toArray($data, $propertyFormat = self::PROPERTY_FORMAT_CAMElCASE)
    {
        $underscoreData = json_decode($this->serialise($data), true);

        if ($propertyFormat === self::PROPERTY_FORMAT_UNDERSCORE) {
            return $underscoreData;
        }

        $camelcaseData = ArrayHelper::underscoreToCamelcase($underscoreData);

        return $camelcaseData;
    }

    protected function serialise($data, $format='json')
    {
        return $this->serializer
            ->serialize(
                $data,
                'json',
                SerializationContext::create()
                    ->enableMaxDepthChecks()
            );
    }


}
