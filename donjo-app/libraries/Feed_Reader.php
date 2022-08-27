<?php class Feed_Reader
{
	function Feed_Reader($sumber_feed='')
	{
		include_once('FeedParser.php');
		$this->sumber_feed = $sumber_feed;
	}

}
