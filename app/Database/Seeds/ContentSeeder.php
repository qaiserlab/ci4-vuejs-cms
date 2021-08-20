<?php namespace App\Database\Seeds;

class ContentSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $rs = [
      [
        'title' => 'Hello',
        'slug' => 'hello',
        'content' => "What’s more friendly that a simple “hello”? This is probably the most 
        common trend that I come across and is simply everywhere in designer 
        portfolios these days. The idea is of course to make the site seem that 
        much more alive and friendly, as if it’s a person welcoming you in. This
         is often effective when combined with a photo or illustration of the 
        designer so it’s clear who the message is coming from",
        'status' => 'Published',
      ], [
        'title' => 'Javascript',
        'slug' => 'javascript',
        'content' => '<p>Kategori ini berisi artikel-artikel yg membahas tentang Javascript. Yaitu bahasa pemrograman client side dan server side web. <a href="'.base_url('category/javascript').'">Selengkapnya...</a><br></p>',
        'status' => 'Published',
      ], [
        'title' => 'PHP',
        'slug' => 'php',
        'content' => '<p>Kategori ini berisi artikel-artikel yg membahas tentang Javascript. Yaitu bahasa pemrograman client side dan server side web.&nbsp;<a href="'.base_url('category/php').'">Selengkapnya...</a></p>',
        'status' => 'Published',
      ], [
        'title' => 'Web Tools',
        'slug' => 'web-tools',
        'content' => '<p>Membahas berbagai tools yg dapat digunakan untuk membantu teknologi web lebih mudah diterapkan dan dikembangkan.&nbsp;<a href="'.base_url('category/web-tools').'">Selengkapnya...</a></p>',
        'status' => 'Published',
      ], [
        'title' => 'About Us',
        'slug' => 'about-us',
        'content' => '<p>QaiserLab adalah media pembelajaran online mengenai pemrograman dan pengembangan teknologi web.</p>',
        'status' => 'Published',
      ], [
        'title' => 'Kontak',
        'slug' => 'kontak',
        'content' => '<p>Jl. Lombok Blok D4 Perum. Langkapura - Bandar Lampung</p>
        <br>
        <p>
          Kirim Email Ke Penulis @<br>
          f.anaturdasa@gmail.com <br></p><p><a href="'.base_url('page/curriculum-vitae').'">Selengkapnya...</a>
          <br>
        </p>',
        'status' => 'Published',
      ], [
        'title' => 'Copyright',
        'slug' => 'copyright',
        'content' => '<p>Copyright © <strong>QaiserLab</strong> 2020<br></p>',
        'status' => 'Published',
      ], [
        'title' => 'Sign Up',
        'slug' => 'sign-up',
        'content' => '<p><strong>Lorem</strong> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.</p><p><span class="ui-trumbowyg" placeholder="Content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.</span><br><br><span class="ui-trumbowyg" placeholder="Content"><span class="ui-trumbowyg" placeholder="Content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.<span class="ui-trumbowyg" placeholder="Content"><br><br><span class="ui-trumbowyg" placeholder="Content"><span class="ui-trumbowyg" placeholder="Content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.</span></span></span></span></span></p><p><span class="ui-trumbowyg" placeholder="Content"></span></p>',
        'status' => 'Published',
      ],
    ];

    $this->db->query('delete from tb_content');
    
    foreach ($rs as $record) {
      $this->db->table('tb_content')->insert($record);
    }
  }
}