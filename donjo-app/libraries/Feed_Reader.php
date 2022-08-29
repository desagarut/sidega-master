<?php class Feed_Reader
{
	function Feed_Reader($sumber_feed='', $sumber_feed1='', $sumber_feed2='', $feed_sthg='')
	{
		include_once('FeedParser.php');
		$this->sumber_feed = $sumber_feed;
		$this->sumber_feed1 = $sumber_feed1;
		$this->sumber_feed2 = $sumber_feed2;
//		$this->sumber_feed3 = $sumber_feed3;
		$this->feed_sthg = $feed_sthg;
		$this->rss_covid($sumber_feed);
		$this->feed_kecamatan($sumber_feed1);
		$this->feed_sindangsari($sumber_feed2);
//		$this->feed_neglasari($sumber_feed3);
		$this->feed_sthg($feed_sthg);
	}

	private function rss_covid($sumber_feed)
	{
		$this->parser = new FeedParser(); 
		$this->parser->parse('https://www.covid19.go.id/feed/'); 
		$this->channels = $this->parser->getChannels(); 
		$this->items = $this->parser->getItems();
	}

	private function feed_kecamatan($sumber_feed1)
	{
		$this->parser = new FeedParser(); 
		$this->parser->parse('https://www.kecamatancisompet.id/feed/'); 
		$this->channels = $this->parser->getChannels(); 
		$this->items1 = $this->parser->getItems();
	}
	
	private function feed_sindangsari($sumber_feed2)
	{
		$this->parser = new FeedParser(); 
		$this->parser->parse('https://www.sindangsari.kecamatancisompet.id/feed/'); 
		$this->channels = $this->parser->getChannels(); 
		$this->items2 = $this->parser->getItems();
	}

	private function feed_neglasari($sumber_feed3)
	{
		$this->parser = new FeedParser(); 
		$this->parser->parse('https://www.neglasari.kecamatancisompet.id/feed/'); 
		$this->channels = $this->parser->getChannels(); 
		$this->items = $this->parser->getItems();
	}

	private function feed_sthg($feed_sthg)
	{
		$this->parser = new FeedParser(); 
		$this->parser->parse('https://www.sthgarut.ac.id/feed/'); 
		$this->channels = $this->parser->getChannels(); 
		$this->items_sthg = $this->parser->getItems();
	}

}
