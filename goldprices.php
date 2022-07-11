<?php
$context = stream_context_create(array('ssl'=>array(
    'verify_peer' => false, 
    "verify_peer_name"=>false
    )));

libxml_set_streams_context($context);


$hochiminhcityGoldPrices = simplexml_load_file('https://sjc.com.vn/xml/tygiavang.xml');
$hochiminhcityGoldPrices = json_decode(json_encode($hochiminhcityGoldPrices->ratelist->city) , true);
$golData = array_column($hochiminhcityGoldPrices['item'], '@attributes');

foreach($golData as $value){
    @$xhtmlGold .= '<tr>
                    <td>' . $value['type'] . '</td>
                    <td>' . $value['buy'] . '</td>
                    <td>' . $value['sell'] . '</td>
                </tr>';
}
?>
<div class="box mt-4">
    <h3 class="mb-1">Giá vàng</h3>
    <div class="card card-body" id="box-gold">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th><b>Loại vàng</b></th>
                    <th><b>Mua vào</b></th>
                    <th><b>Bán ra</b></th>
                </tr>
            </thead>
            <tbody>
                <?= $xhtmlGold; ?>
            </tbody>
        </table>
        <!-- <div class="text-center">
                                            <div class="spinner-border" style="width: 3rem; height: 3rem;"
                                                role="status">
                                            </div>
                                        </div> -->
    </div>
</div>