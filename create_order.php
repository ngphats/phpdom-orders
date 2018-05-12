<?php 
$dom = new DOMDocument();

$orders = $dom->createElement('orders');
$dom->appendChild($orders);

// order 1
$order1 = $dom->createElement('order');
$orders->appendChild($order1);
$customer1 = $dom->createElement('customer');
$order1->appendChild($customer1);

// customer name
$nameCustomer1 = $dom->createAttribute('name');
$nameCustomer1->value = 'Hdcomputer';
$customer1->appendChild($nameCustomer1);

// customer phone
$phoneCustomer1 = $dom->createAttribute('phone');
$phoneCustomer1->value = '098789789';
$customer1->appendChild($phoneCustomer1);

// customer email
$emailCustomer1 = $dom->createAttribute('email');
$emailCustomer1->value = 'hd@gmail.com';
$customer1->appendChild($emailCustomer1);

// products
$products1 = $dom->createElement('products');
$order1->appendChild($products1);

// product 1
$product1_1 = $dom->createElement('product');
$products1->appendChild($product1_1);

// product name
$nameProduct1_1 = $dom->createAttribute('name');
$nameProduct1_1->value = 'PHP Basic'; 
$product1_1->appendChild($nameProduct1_1);

//

// order 2
$order2 = $dom->createElement('order');
$orders->appendChild($order2);
$customer2 = $dom->createElement('customer');
$order2->appendChild($customer2);

// customer name
$nameCustomer2 = $dom->createAttribute('name');
$nameCustomer2->value = 'Phong Vu';
$order2 = $customer2->appendChild($nameCustomer2);

// customer phone
$phoneCustomer2 = $dom->createAttribute('phone');
$phoneCustomer2->value = '098789789';
$order2 = $customer2->appendChild($phoneCustomer2);

// customer email
$emailCustomer2 = $dom->createAttribute('email');
$emailCustomer2->value = 'hd@gmail.com';
$order2 = $customer2->appendChild($emailCustomer2);


$dom->save('orders.xml');
echo 'Done!';