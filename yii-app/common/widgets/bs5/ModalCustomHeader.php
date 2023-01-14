<?php
/**
 *
 * @since 2022-03-30 17:21
 */
declare(strict_types=1);

namespace common\widgets\bs5;

use yii\bootstrap5\Html;

class ModalCustomHeader extends \yii\bootstrap5\Modal
{
    /**
     * {@inheritDoc}
     * @see \yii\bootstrap5\Modal::renderHeader()
     */
    protected function renderHeader(): string
    {
        $button = $this->renderCloseButton();
        if (isset($this->title)) {
            Html::addCssClass($this->titleOptions, ['widget' => 'modal-title h5']);
            $header = Html::tag('div', $this->title, $this->titleOptions);
        } else {
            $header = '';
        }

        if ($button !== null) {
            $header .= "\n" . $button;
        } elseif ($header === '') {
            return '';
        }
        Html::addCssClass($this->headerOptions, ['widget' => 'modal-header']);

        return Html::tag('div', "\n" . $header . "\n", $this->headerOptions);
    }

}
