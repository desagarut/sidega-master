<?php

class Produk_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
 		$this->load->model('header_model');
	}
	
	//Awal kategorigaleri
	function Getkategorigaleri() {
		return $this->db->query("select * from tbl_kategorigaleri order by id_kategorigaleri desc");
	}

	function kategorigaleriSama($nama_kategorigaleri) {
		return $this->db->query("select * from tbl_kategorigaleri where binary(nama_kategorigaleri)='$nama_kategorigaleri' ");
	}

	function kategorigaleriSimpan($nama_kategorigaleri) {
		return $this->db->query("insert into tbl_kategorigaleri values('','$nama_kategorigaleri')");
	}

	function Deletekategorigaleri($id_kategorigaleri) {
		return $this->db->query("delete from tbl_kategorigaleri where id_kategorigaleri='$id_kategorigaleri'");
	}

	function GetEditkategorigaleri($id_kategorigaleri) {
		return $this->db->query("select * from tbl_kategorigaleri where id_kategorigaleri='$id_kategorigaleri'");
	}
	function kategorigaleriUpdate($id_kategorigaleri,$nama_kategorigaleri) {
		return $this->db->query("update tbl_kategorigaleri set nama_kategorigaleri='$nama_kategorigaleri' where id_kategorigaleri='$id_kategorigaleri'");
	}
	//Akhir kategorigaleri

	//Awal Galeri
	function GetGaleri() {
		return $this->db->query("select a.*,b.* from tbl_galeri a join tbl_kategorigaleri b on a.kategorigaleri_id=b.id_kategorigaleri order by a.id_galeri desc");
	}
	function DeleteGaleri($id_galeri) {
		return $this->db->query("delete from tbl_galeri where id_galeri='$id_galeri' ");
	}

	function GetGaleriEdit($id_galeri) {
		return $this->db->query("select * from tbl_galeri where id_galeri='$id_galeri' ");
	}
	//Ahir Galeri

	//Awal kontak

	function Getkontak() {
		return $this->db->query("select * from tbl_kontak");
	}

	function Simpankontak($id_kontak,$alamat,$phone,$email){
		return $this->db->query("update tbl_kontak set alamat='$alamat',phone='$phone',email='$email' where id_kontak='$id_kontak' ");
	}
	//Akhir kontak

	//Awal Kategori
	function GetKategori() {
		return $this->db->query("select * from tbl_kategori order by id_kategori desc");
	}

	function KategoriSama($nama_kategori) {
		return $this->db->query("select * from tbl_kategori where binary(nama_kategori)='$nama_kategori' ");
	}

	function KategoriSimpan($nama_kategori) {
		return $this->db->query("insert into tbl_kategori values('','$nama_kategori')");
	}

	function DeleteKategori($id_kategori) {
		return $this->db->query("delete from tbl_kategori where id_kategori='$id_kategori'");
	}

	function GetEditKategori($id_kategori) {
		return $this->db->query("select * from tbl_kategori where id_kategori='$id_kategori'");
	}
	function KategoriUpdate($id_kategori,$nama_kategori) {
		return $this->db->query("update tbl_kategori set nama_kategori='$nama_kategori' where id_kategori='$id_kategori'");
	}
	//Akhir Kategori

	//Awal Brand
	function GetBrand() {
		return $this->db->query("select * from tbl_brand order by id_brand desc");
	}

	function BrandSama($nama_brand) {
		return $this->db->query("select * from tbl_brand where binary(nama_brand)='$nama_brand' ");
	}

	function BrandSimpan($nama_brand) {
		return $this->db->query("insert into tbl_brand values('','$nama_brand')");
	}

	function DeleteBrand($id_brand) {
		return $this->db->query("delete from tbl_brand where id_brand='$id_brand'");
	}

	function GetEditBrand($id_brand) {
		return $this->db->query("select * from tbl_brand where id_brand='$id_brand'");
	}
	function BrandUpdate($id_brand,$nama_brand) {
		return $this->db->query("update tbl_brand set nama_brand='$nama_brand' where id_brand='$id_brand'");
	}
	//Akhir Brand

	//Awal Kota
	function GetKota() {
		return $this->db->query("select * from tbl_kota order by id_kota desc");
	}

	function KotaSama($nama_kota) {
		return $this->db->query("select * from tbl_kota where binary(nama_kota)='$nama_kota' ");
	}

	function KotaSimpan($nama_kota) {
		return $this->db->query("insert into tbl_kota values('','$nama_kota')");
	}

	function DeleteKota($id_kota) {
		return $this->db->query("delete from tbl_kota where id_kota='$id_kota'");
	}

	function GetEditKota($id_kota) {
		return $this->db->query("select * from tbl_kota where id_kota='$id_kota'");
	}
	function KotaUpdate($id_kota,$nama_kota) {
		return $this->db->query("update tbl_kota set nama_kota='$nama_kota' where id_kota='$id_kota'");
	}
	//Akhir Kategori


	//Awal Bank
	function GetBank() {
		return $this->db->query("select * from tbl_bank order by id_bank desc");
	}
	function DeleteBank($id_bank) {
		return $this->db->query("delete from tbl_bank where id_bank='$id_bank' ");
	}

	function GetBankEdit($id_bank) {
		return $this->db->query("select * from tbl_bank where id_bank='$id_bank' ");
	}
	//Ahir Bank

	//Awal Cara Belanja
	function GetCarabelanja() {
		return $this->db->query("select * from tbl_carabelanja");
	}

	function UpdateCarabelanja($id_carabelanja,$judul,$deskripsi){
		return $this->db->query("update tbl_carabelanja set judul='$judul',deskripsi='$deskripsi' where id_carabelanja='$id_carabelanja'");
	}
	//Akhir Cara Belanja

	//Awal Jasa Pengiriman
	function GetJasapengiriman() {
		return $this->db->query("select * from tbl_jasapengiriman order by id_jasapengiriman desc");
	}
	function DeleteJasapengiriman($id_jasapengiriman) {
		return $this->db->query("delete from tbl_jasapengiriman where id_jasapengiriman='$id_jasapengiriman' ");
	}

	function GetJasapengirimanEdit($id_jasapengiriman) {
		return $this->db->query("select * from tbl_jasapengiriman where id_jasapengiriman='$id_jasapengiriman' ");
	}
	//Ahir Galeri

	//Awal produk

	function GetProduk() {
		return $this->db->query("select a.*,b.nama_brand,c.nama_kategori from tbl_produk a join tbl_brand b on a.brand_id=b.id_brand join tbl_kategori c on a.kategori_id=c.id_kategori order by a.id_produk desc");
	}

	function GetMaxKodeProduk() {

		$query = $this->db->query("select MAX(RIGHT(kode_produk,5)) as kode_produk from tbl_produk");
		$kode ="";
		if($query->num_rows()>0) {
			foreach ($query->result() as $tampil) {
				$kd = ((int)$tampil->kode_produk)+1;
				$kode = sprintf("%05s",$kd);
			}
		}
		else {
			$kode="00001";
		}
		return "AMX".$kode;
	}

	function DeleteProduk($id_produk) {
		return $this->db->query("delete from tbl_produk where id_produk='$id_produk' ");
	}

	function EditProduk($id_produk){
		return $this->db->query("select * from tbl_produk where id_produk='$id_produk' ");
	}
	//Akhir Produk

	//Awal Slider

	function GetSlider() {
		return $this->db->query("select * from tbl_slider order by id_slider desc");
	}

	function DeleteSlider($id_slider) {
		return $this->db->query("delete from tbl_slider where id_slider='$id_slider' ");
	}

	function EditSlider($id_slider){
		return $this->db->query("select * from tbl_slider where id_slider='$id_slider' ");
	}
	//Akhir Slider

	//Awal Buku Tamu

	function GetBukuTamu () {
		return $this->db->query("select * from tbl_hubungikami order by status asc");
	}

	function DeleteBukuTamu($id) {
		return $this->db->query("delete from tbl_hubungikami where id_hubungikami='$id'");
	}

	function DetailBukuTamu($id) {
		return $this->db->query("select * from tbl_hubungikami where id_hubungikami='$id'");
	}

	function UpdateStatusBukuTamu($status,$id) {
		return $this->db->query("update tbl_hubungikami set status='$status' where id_hubungikami='$id'");
	}

	function SimpanBukuTamuAdd($email,$judul,$isi_hubungi_kami_kirim) {
		return $this->db->query("insert into tbl_hubungi_kami_kirim values('','$email','$judul','$isi_hubungi_kami_kirim')");	
	}

	function GetBukuTamuKirim() {
		return $this->db->query("select * from tbl_hubungi_kami_kirim order by id_hubungi_kami_kirim desc");
	}

	function DeleteBukuTamuKirim($id) {
		return $this->db->query("delete from tbl_hubungi_kami_kirim where id_hubungi_kami_kirim='$id'");
	}

	function DetailBukuTamuKirim($id) {
		return $this->db->query("select * from tbl_hubungi_kami_kirim where id_hubungi_kami_kirim='$id'");
	}
	
	//Akhir Buku Tamu


	//Awal Transaksi

	function GetTransaksi() {
		return $this->db->query("select a.*,b.*,c.* from tbl_transaksi_header a
		join tbl_bank b on a.bank_id=b.id_bank
		join  tbl_jasapengiriman c on a.jasapengiriman_id=c.id_jasapengiriman
		where a.status='0' order by a.id_transaksi_header asc  ");
	}

	function UpdateTransaksiHeader($id) {
		return $this->db->query("update tbl_transaksi_header set status='1' where id_transaksi_header='$id'  ");
	}

	function GetTransaksiheader($id) {
		return $this->db->query("select a.*,b.*,c.* from tbl_transaksi_header a
		join tbl_bank b on a.bank_id=b.id_bank
		join  tbl_jasapengiriman c on a.jasapengiriman_id=c.id_jasapengiriman
		where a.id_transaksi_header='$id' ");
	}

	function GetDetailTransaksi($kode_transaksi) {
		return $this->db->query("select * from tbl_transaksi_detail where kode_transaksi='$kode_transaksi' order by id_transaksi_detail desc ");
	}

	function GetDetailTotal($kode_transaksi) {
		return $this->db->query("select sum(harga) as total from tbl_transaksi_detail where kode_transaksi='$kode_transaksi' order by id_transaksi_detail desc ");
	}

	function GetTransaksiSudah() {

		return $this->db->query("select a.*,b.*,c.* from tbl_transaksi_header a
		join tbl_bank b on a.bank_id=b.id_bank
		join  tbl_jasapengiriman c on a.jasapengiriman_id=c.id_jasapengiriman
		where a.status='1' order by a.id_transaksi_header asc  ");

	}

	//Akhir Transaki

	
}