<?php
use Ajung\Api;

require __DIR__ . '/vendor/autoload.php';

// informa a chave de acesso a API como parametro
$api = new Api('');

$products = [];

// Faz a primeira chamada (pagina 1)
$result = $api->call('GET', '/products');
$products = $result->products->data;

// Pega o total de paginas para fazer a paginacao
$pages = $result->products->last_page;
if ($pages > 1) {
    for ($i = 2; $i <= $pages; $i++) {
        $result = $api->call('GET', '/products?page=' . $i);
    
        array_push($products, ...$result->products->data);
    }
}

// exibe os produtos
foreach ($products as $product) {
    echo "-> {$product->name} - {$product->code}". PHP_EOL;
}
echo "total de produtos: " . count($products) . PHP_EOL;