<?php
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
    'start' => '1',
    'limit' => '10',
    'convert' => 'USD'
];

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 4ff33e2d-4964-46a2-8412-f5010072cf23'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
$response = json_decode($response, true);
$coinData = $response['data'];

curl_close($curl); // Close request

foreach ($coinData as $value) {
    $price = round($value['quote']['USD']['price'], 3);
    $percentChange1h = round($value['quote']['USD']['percent_change_1h'], 3);
    $red = $percentChange1h < 0 ? 'red' : '';
    @$xhtmlCoin .= '<tr>
                    <td>' . $value['name'] . '</td>
                    <td>' . $price . '</td>
                    <td><span class="text-success ' . $red . '">' . $percentChange1h . '</span></td>
                </tr>';
}
?>
<div class="box mt-4">
    <h3 class="mb-1">Giá coin</h3>
    <div class="card card-body" id="box-coin">

        <table class="table table-sm">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Price (USD)</b></th>
                    <th><b>Change (24h)</b></th>
                </tr>
            </thead>
            <tbody>
                <?= $xhtmlCoin; ?>
            </tbody>
        </table>
    </div>
</div>