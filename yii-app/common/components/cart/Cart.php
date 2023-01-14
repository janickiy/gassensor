<?php


namespace common\components\cart;

use common\models\Product;
use yii\base\Component;

/**
 * @property CartItem[] $items
 */
class Cart extends Component
{
    const EVENT_AFTER_ADD_ITEM = 'EVENT_AFTER_ADD_ITEM';
    const EVENT_AFTER_REMOVE_ITEM = 'EVENT_AFTER_REMOVE_ITEM';
    const EVENT_AFTER_CLEAR = 'EVENT_AFTER_CLEAR';
    const EVENT_AFTER_CHANGE_COUNT = 'EVENT_AFTER_CHANGE_COUNT';
    const SESSION_KEY = 'SESSION_KEY_CART';

    /**
     * @var CartItem[]
     */
    protected $_items;

    public function init()
    {
        $this->_items = \Yii::$app->session->get(self::SESSION_KEY, []);
        $this->on(self::EVENT_AFTER_ADD_ITEM, [$this, 'storeData']);
        $this->on(self::EVENT_AFTER_REMOVE_ITEM, [$this, 'storeData']);
        $this->on(self::EVENT_AFTER_CLEAR, [$this, 'storeData']);
        $this->on(self::EVENT_AFTER_CHANGE_COUNT, [$this, 'storeData']);
    }

    protected function storeData()
    {
        \Yii::$app->session->set(self::SESSION_KEY, $this->items);
    }

    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @param $id
     * @return CartItem|null
     */
    public function getItem($id)
    {
        return $this->_items[$id] ?? null;
    }

    /**
     * @param $id
     * @return Product|null
     */
    public function getItemProduct($id)
    {
        $item = $this->getItem($id);
        return $item ? $item->product : null;
    }

    public function isEmpty()
    {
        return empty($this->_items);
    }

    /**
     * @param Product $model
     * @param int $count
     */
    public function addItem(Product $model, $count = 1)
    {
        if (!$this->_items) {//init empty
            $this->_items = [];
        }

        if (empty($this->_items[$model->id])) {
            $this->_items[$model->id] = new CartItem([
                'product' => $model,
                'count' => $count,
            ]);
        } else {
            $this->_items[$model->id]->count += $count;
        }

        $this->trigger(self::EVENT_AFTER_ADD_ITEM);
    }

    /**
     * @param $productId
     */
    public function removeItem($productId)
    {
        if (empty($this->_items[$productId])) {
            return;
        }

        unset($this->_items[$productId]);

        $this->trigger(self::EVENT_AFTER_REMOVE_ITEM);
    }

    /**
     * @param $productId
     * @param $count
     */
    public function changeCount($productId, $count)
    {
        if (empty($this->_items[$productId]) || $count < 1) {
            return;
        }

        $this->_items[$productId]->count = $count;
        $this->trigger(self::EVENT_AFTER_CHANGE_COUNT);
    }

    public function clear()
    {
        $this->_items = null;
        $this->trigger(self::EVENT_AFTER_CLEAR);
    }

    /**
     * @return number
     */
    public function getItemsCount()
    {
        $count = 0;
        foreach ($this->_items as $cartItem) {
            $count += $cartItem->count;
        }

        return $count;
    }

    /**
     * @return number
     */
    public function getTotalItemsPrice($shop)
    {
        $total = 0;

        throw new \Exception('todo');

        if (!$products = $this->items[$shop->id]) {
            return $total;
        }

        foreach ($products as $cartItem) {
            $total += $cartItem->getProductPriceWithPackage();
        }

        return $total;
    }


}

