<?php 

// USD sell
$exrate = new DOMDocument();
$exrate->load("http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx");
$usd = $exrate->getElementsByTagName('Exrate');
foreach ($usd as $value) {
	if ($value->getAttribute('CurrencyCode') == 'USD') {

		$exrateSell = $value->getAttribute('Sell');

		break;
	}
}

echo "USD: ".$exrateSell;

$dom = new DOMDocument();
$dom->load('vd.xml');

$viewDetail = 0;

if (isset($_GET['detail'])) {

	$id = $_GET['detail'];

	$orders = $dom->getElementsByTagName('order');
	foreach($orders as $order) {

		$orderId = $order->getAttribute('id');
		if ($orderId == $id) {
			$orderData = $order->getElementsByTagName('customer')->item(0);

			$data[$orderId] = [
				'name'	=> $orderData->getAttribute('name'),
				'phone'	=> $orderData->getAttribute('phone'),
				'email'	=> $orderData->getAttribute('email')
			];

			$productData = $order->getElementsByTagName('product');

			foreach ($productData as $product) {
				$data[$orderId]['products'][] = [
					'name'	=> $product->getAttribute('name'),
					'qty'	=> $product->getAttribute('qty'),
					'price'	=> $product->getAttribute('price')
				];
			}

			break;
		}
	}

	// do something
	$viewDetail = 1;
} else {
	$orders = $dom->getElementsByTagName('order');
	foreach($orders as $order) {

		$orderId = $order->getAttribute('id');

		$orderData = $order->getElementsByTagName('customer')->item(0);

		$data[$orderId] = [
			'name'	=> $orderData->getAttribute('name'),
			'phone'	=> $orderData->getAttribute('phone'),
			'email'	=> $orderData->getAttribute('email')
		];

		// total price
		$totalPrice = 0;
		$products = $order->getElementsByTagName('product');
		foreach ($products as $product) {
			$qty = $product->getAttribute('qty');
			$price = $product->getAttribute('price');
			$totalPrice = $totalPrice + ($qty * $price) + (($qty * $price) * 0.1);
		} 

		$data[$orderId]['total_price'] = $totalPrice;
	}
}
?>

<?php if ($viewDetail == 0) : ?>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>STT</td>
		<td>Name</td>
		<td>Phone</td>
		<td>Total Price</td>
		<td>Detail</td>
	</tr>
	<?php foreach($data as $id => $order) : ?>
	<tr>
		<td><?= $id ?></td>
		<td><?= $order['name'] ?></td>
		<td><?= $order['phone'] ?></td>
		<td><?= number_format($order['total_price'] * $exrateSell) ?></td>
		<td><a href="?detail=<?= $id ?>">Detail</a></td>
	</tr>
	<?php endforeach ?>
</table>
<?php else : ?>
	<article>
		<h3>Customer</h3>
		<ul>
			<li>Name: <?= $data[$id]['name'] ?></li>
			<li>Phone: <?= $data[$id]['phone'] ?></li>
			<li>Email: <?= $data[$id]['email'] ?></li>
		</ul>
	</article>
<table  border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>STT</td>
		<td>Name</td>
		<td>Qty</td>
		<td>Price</td>
		<td>Total</td>
	</tr>
	<?php $totalPrice = 0; ?>
	<?php foreach($data[$id]['products'] as $key => $product) : ?>
	<tr>
		<td><?= $key + 1 ?></td>
		<td><?= $product['name'] ?></td>
		<td><?= $product['qty'] ?></td>
		<td><?= number_format($product['price'] * $exrateSell) ?></td>
		<?php 
			$total = $product['qty'] * ($product['price'] * $exrateSell);
			$totalPrice = $totalPrice + $total;
		?>
		<td><?= number_format($total) ?></td>
	</tr>
	<?php endforeach ?>
	<tr>
		<td colspan="4">Total</td>
		<td><?= number_format($totalPrice) ?></td>	
	</tr>
	<tr>
		<td colspan="4">VAT</td>
		<td><?= $vat = number_format($totalPrice * 0.1) ?></td>
	</tr>
	<tr>
		<td colspan="4">Total price</td>
		<td><?= number_format($totalPrice + $vat) ?></td>
	</tr>
		
</table>
<?php endif ?>