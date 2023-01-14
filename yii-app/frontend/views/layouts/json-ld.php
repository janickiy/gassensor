<?php
use yii\helpers\Url;

/* @var $this \yii\web\View */
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "url": "https://gassensor.ru/",
  "logo": "https://gassensor.ru/i/logo.svg"
}
</script>

<script type="application/ld+json">
{
  "@context":"http://schema.org",
  "@type":"ItemList",
  "itemListElement":[
    {
      "@type":"SiteNavigationElement",
      "position":1,
      "name": "Главная",
      "description": "Главная",
      "url":"https://gassensor.ru"
    },
    {
      "@type":"SiteNavigationElement",
      "position":2,
      "name": "Производители",
      "description": "Производители",
      "url":"https://gassensor.ru/manufacture"
    },
    {
      "@type":"SiteNavigationElement",
      "position":3,
      "name": "Каталог",
      "description": "Каталог",
      "url":"https://gassensor.ru/catalog"
    },
    {
      "@type":"SiteNavigationElement",
      "position":4,
      "name": "Аксессуары",
      "description": "Аксессуары",
      "url":"https://gassensor.ru/page/accessories"
    },
    {
      "@type":"SiteNavigationElement",
      "position":5,
      "name": "Конвертер газа",
      "description": "Конвертер газа",
      "url":"https://gassensor.ru/converter"
    },
    {
      "@type":"SiteNavigationElement",
      "position":6,
      "name": "Контакты",
      "description": "Контакты",
      "url":"https://gassensor.ru/page/contacts"
    }
  ]
}
</script>

<?php


if ($breadcrumbs = $this->params['breadcrumbs'] ?? []) {
    foreach ($breadcrumbs as $k => &$v) {
        $item = [
            '@type' => 'ListItem',
            'position' => $k + 1,
            'name' => is_array($v) ? $v['label'] : $v,
        ];
        if ($url = $v['url'] ?? null) {
            $url = is_array($url) ? Url::toRoute($url) : $url;
            $item['item'] = 'https://gassensor.ru' . $url;
        }

        $v = $item;
        unset($v);//kill ref
    }
}

$json = json_encode($breadcrumbs, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": <?= $json ?>
}
</script>

<?php if ($json = $this->params['productJsonLd'] ?? null): ?>
<script type="application/ld+json">
<?= $json ?>

</script>
<?php endif; ?>

