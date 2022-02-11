<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--  Feed dari situs lain -->

<div class="newsfeed">
	<?php if ($feed_sthg['items_sthg']): ?>
    <h3 class="content__heading"><i class="fa fa-newspaper-o"></i> <a href="<?= $feed_sthg['url']?>" target='_blank'><?= $feed_sthg['title'] ?></a></h3>
    
    <?php foreach ($feed_sthg['items_sthg'] as $data): ?>
    <ul class="content__list">
        <li class="content__item">
            <!--<a href="https://covid19.go.id" class="content__thumbnail">
                <img src="https://covid19.go.id/storage/app/media/logo-kpcpen.png" alt="" class="content__image">
            </a>-->
            <div class="content__caption">
                <h4 class="content__title_rss"><a href="<?= $data['LINK'] ?>" target="_blank" class="content__link"><?= $data["TITLE"] ?></a></h4>
                <div class="content__meta">
                    <span class="content__meta__item"><i class="fa fa-calendar content__meta__icon"></i> <?= gmdate("d-M-Y H:i:s", $data['PUBDATE']) ?></span>
                    <span class="content__meta__item"><i class="fa fa-user content__meta__icon"></i> <?= $data['DC:CREATOR'] ?></span>
                                    <span class="content__meta__item"><i class="fa fa-tag content__meta__icon"></i> <?= $data['CATEGORY'] ?></span>
				</div>
                <div class="content__description">
                    <p><?= str_split($data['DESCRIPTION'], 300)[0] ?><a href="<?= $data['LINK'] ?>"> <button class="button">selengkapnya</button></a></p>
                </div>
            </div>
        </li>
		<?php endforeach; ?>
    </ul>
	<?php endif; ?>
</div>