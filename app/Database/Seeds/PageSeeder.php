<?php namespace App\Database\Seeds;

class PageSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $this->db->query('delete from tb_page');
    $this->db->table('tb_page')->insert([
      'title' => 'Curriculum Vitae',
      'slug' => 'curriculum-vitae',
      'image' => 'fadlun-anaturdasa.png',
      'content' => '<p>Penulis
        adalah seorang Programmer yg telah lebih dari 10 tahun menggeluti dunia
        pemrograman dan IT. Perkenalkan nama saya Fadlun Anaturdasa Wibawa, 
        saya sangat menyukai bidang pekerjaan saya sebagai Programmer. Berikut 
        ini profile lengkap saya;&nbsp;
        
        </p><p><p><p><p><h4>Personal Information</h4>
        <ul><li>Nama: Fadlun Anaturdasa Wibawa</li><li>Alamat: Jl. Lombok Blok D4 Perum. Langkapura</li><li>Kota: Bandar Lampung</li><li>Email: f.anaturdasa@qaiserlab.com</li><li>Tanggal Lahir: 29 Agustus 1985</li><li>Tempat Lahir: T. Karang, Bandar Lampung</li><li>Jenis Kelamin: Laki-laki</li><li>Status: Menikah</li></ul>
        <h4>Work History</h4>
        <ul><li>PT. Multimedia Solusi Prima, sebagai Programmer</li><li>PT. Inul Vizta Pratama, sebagai IT Support</li><li>Glovory LLC, sebagai Programmer</li></ul>
        <h4>Skills</h4>
        <p>Programming Language</p>
        <ul><li>HTML</li><li>CSS</li><li>Javascript</li><li>PHP</li><li>SQL</li></ul>
        <p>Framework/Libraries</p>
        <ul><li>JQuery</li><li>React JS</li><li>Vue JS</li><li>Bootstrap</li><li>Express JS</li><li>Code Igniter</li></ul>
        <p>Platform Familiar</p>
        <ul><li>Ubuntu</li><li>XAMPP</li><li>NodeJS</li><li>Cordova</li></ul>
        <p>Concept Implementation Experience</p>
        <ul><li>OOP</li><li>MVC</li><li>Web Service API</li><li>Single Page Application</li></ul>
        <p>Able to Write</p>
        <ul><li>Web Application</li><li>Mobile Application</li><li>Desktop Application</li></ul></p></p></p></p>',
      'view' => 0,
      'postedOn' => date('Y-m-d h:i:s'),
      'status' => 'Published',
    ]);
  }
}