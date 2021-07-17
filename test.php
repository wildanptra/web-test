<?php
$_POST['tgl'] = '1996-10-01';
$_POST['total'] = 100000;
$_POST['detail'] = [
    [
        "order_id" => '12',
        "product_id" => '12',
        "price" => null,
    ],
    [
        "order_id" => '12',
        "product_id" => '12',
        "price" => null,
    ],
];

foreach($_POST['detail'] as $key => $value){
    foreach($value as $detail => $order) {
        echo "array {$key} has a {$detail} value {$order}, <br> ";
        // print_r($_POST);
    }
}

// function save() // add controller 
// ->save() = id
// ->save(id)

print_r($_POST);