<?php
/**
 * generated 21-10-19 11:57:47
 *
 */

namespace common\models\query;

use common\models\base\GazBaseQuery;

class GazQuery extends GazBaseQuery
{
    public function freons()
    {
        return $this->andWhere('title LIKE "%фреон%"');
    }

    public function notFreons()
    {
        return $this->andWhere('title NOT LIKE "%фреон%"');
    }

}