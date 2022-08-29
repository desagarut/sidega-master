<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Rss extends CI_Controller {
 
public function __construct()
{
parent::__construct();
//meload library rssparser
$this->load->library('rssparser');
}
public function index()
{
$this->rssparser->set_feed_url('http://detik.feedsportal.com/c/33613/f/656101/index.rss');
$this->rssparser->set_cache_life(30);
$rss['list'] = $this->rssparser->getFeed(5);
$this->load->view('rss',$rss);
}
}