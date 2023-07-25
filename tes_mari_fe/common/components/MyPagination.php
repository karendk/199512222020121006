<?php
namespace common\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class MyPagination extends \yii\widgets\LinkPager
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
    }

    // protected function renderPageButton($label, $page, $class, $disabled, $active)
    // {
    //     $options = ['class' => $class === '' ? null : $class];
    //     if ($active) {
    //         Html::addCssClass($options, $this->activePageCssClass);
    //     }
    //     if ($disabled) {
    //         Html::addCssClass($options, $this->disabledPageCssClass);
    //         return Html::tag('li', Html::tag('span', $label), $options);
    //     }
    //     $linkOptions              = $this->linkOptions;
    //     $linkOptions['data-page'] = $page;
    //     $linkOptions['onclick']   = 'submit_form(' . $page . ')';
    //     $linkOptions['class']   = 'page-link';

    //     return Html::tag('li', Html::a($label, '?page='.$page, $linkOptions), $options);
    // }

    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        
    $options = $this->linkContainerOptions;
    $linkWrapTag = ArrayHelper::remove($options, 'tag', 'li');
    Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

    if ($active) {
        // Html::addCssClass($options, $this->activePageCssClass);
        Html::addCssClass($options, ['class'=>'page-item active']);
    }
    if ($disabled) {
        // Html::addCssClass($options, $this->disabledPageCssClass);
        Html::addCssClass($options, ['class'=>'page-item disabled']);
        $disabledItemOptions = $this->disabledListItemSubTagOptions;
        $tag = ArrayHelper::remove($disabledItemOptions, 'tag', 'span');

        // return Html::tag($linkWrapTag, Html::tag($tag, $label, $disabledItemOptions), $options);
        return Html::tag($linkWrapTag, Html::tag('a', $label, ['class'=>'page-link']), $options);

    }
    $linkOptions = $this->linkOptions;
    $linkOptions['data-page'] = $page;
    $linkOptions['class'] = 'page-link';

    return Html::tag($linkWrapTag, Html::a($label, $this->pagination->createUrl($page), $linkOptions), $options);
    }
}
