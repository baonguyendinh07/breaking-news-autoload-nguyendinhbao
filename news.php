<?php
require_once 'libs/simple_html_dom.php';
$link = file_get_html('https://vnexpress.net/atp-wta-khong-tinh-diem-wimbledon-4466336.html');
$title = $link->find('h1.title-detail')[0]->innertext;
$description = $link->find('p.description')[0]->innertext;
$element = 'data-src';
$image = $link->find('img.lazy')[0]->$element;
$pubDate = $link->find('span.date')[0]->innertext;

$data = simplexml_load_file('https://vnexpress.net/rss/the-thao.rss');
$dataNews = $data->channel->item;

foreach ($dataNews as $value) {
    preg_match_all('#.*src="(.*)".*</br>(.*)<end>#imsU', $value->description . '<end>', $matches);

    $matches = array_column($matches, '0');
    $image = $matches[1];
    $description = $matches[2];

    @$xhtmlNews .= '
                    <div class="col-md-6 col-lg-4 p-3">
                        <div class="entry mb-1 clearfix">
                            <div class="entry-image mb-3">
                                <a href="' . $image . '" data-lightbox="image" style="background: url('. $image .') no-repeat center center; background-size: cover; height: 278px;"></a>
                            </div>
                            <div class="entry-title">
                                <h3><a href="' . $value->link . '" target="_blank">' . $value->title . '</a>
                                </h3>
                            </div>
                            <div class="entry-content">' . $description . '</div>
                            <div class="entry-meta no-separator nohover">
                                <ul class="justify-content-between mx-0">
                                    <li><i class="icon-calendar2"></i>' . $value->pubDate . '</li>
                                    <li>vnexpress.net</li>
                                </ul>
                            </div>
                            <div class="entry-meta no-separator hover">
                                <ul class="mx-0">
                                    <li><a href="' . $value->link . '" target="_blank">Xem &rarr;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    ';
}   
?>
<section id="content" class="bg-light">
    <div class="content-wrap pt-lg-0 pt-xl-0 pb-0">
        <div class="container-fluid clearfix">
            <div class="heading-block border-bottom-0 center pt-4 mb-3">
                <h3>Tin tức</h3>
            </div>
            <!-- Posts -->
            <div class="row grid-container infinity-wrapper clearfix align-align-items-start">
                    <?= $xhtmlNews; ?>
            </div>
        </div>
    </div>
</section>