<?php class Feed_Reader
{
	function Feed_Reader($sumber_feed='', $feed_sthg='')
	{
		include_once('FeedParser.php');
		$this->sumber_feed = $sumber_feed;
		$this->feed_sthg = $feed_sthg;
	}

}
