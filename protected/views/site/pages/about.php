<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<div class="static_content">
<h1>About</h1>

<?php
$provinces = array(
    1=>250,//Central Province
    2=>320,//'Eastern Province',
    3=>250,//'North Central',
    4=>250,//'North Western'=>4,
    5=>320,//'Nothern'=>5,
    6=>250,//'Sabaragamuwa'=>6,
    7=>250,//'Southern'=>7,
    8=>250,//'Uva'=>8,
    9=>250,//'Western'=>9,
);

$cities = ShippingCities::model()->findAll();
foreach($cities As $c){
    $province_id = $c->province_id;
    $city_id = $c->id;
    $cat = 1;
    $comp = 1;
    $price = 0;
    if(key_exists($province_id, $provinces)){
        $price = $provinces[$c->province_id];
    }
    echo "INSERT INTO `shipping_rates` (`id`,`province_id`, `city_id`,`shipping_category_id`,`price`,`shipping_company_id`) VALUES (NULL, '$province_id', '$city_id','$cat','$price','$comp');".'<br>';
}
?>
</div>