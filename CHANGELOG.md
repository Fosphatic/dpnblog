# Changelog

## 1.4.7

**September 19, 2018 12:18 PM**

### Add

- Highlight.js if you use <pre><code class="css"> Your code goes here </code></pre> in the blog post to enable nice syntax highlitning

Attention: If you have post.php overrides in your template -> views -> dpnblog folder then you need to make some changes to bind the needed js as css files and last but not least the script section for hightlight.js as well.

## 1.4.6

**August 1, 2018 12:18 PM**

### Translation bugfixing

## 1.4.0

**July 15, 2018 11:18 PM**

### Add

- Social Share ``Twitter``
- Like System

## 1.2.1

**July 6, 2018 11:51 AM**

### Add

- Tags sayfası eklendi

### Fixed

- Kategori düzenlerken meta verilerin boşa çıkma sorunu düzeltildi.

## 1.1.3

**June 29, 2018 3:04 PM**

### Change

- Dpnblog reposu pastheme taşındı.
- Tablo yapısı ayrı olarak hesaplandı Orjinal blog uzantısından tamamen farklı kılındı.


## 1.1.2

**June 27, 2018 10:53 AM**

### Add New

- Makaleyi yazan kişinin avatarı gözükmesi sağlanıyor artık.

### Fixed

- Admin panel linki yenilendi.
- posts sayfası kontrol edildi ve sorun düzeltildi.
- Meta Title ve Desc Hatası yapıldı category meta için.

**June 26, 2018 10:53 PM**

### Error Found
- ~~Admin paneldeki yeni kategori ekle butonuna `admin to @dpnblog` şeklinde değiştirilecek 404'e gidiyor. (views/admin/category-index | ** 16. line ** )~~
- ~~posts sayfasında kategori linkleri çalışmıyor. Bunun sebebi index.php'deki 31. satırda. `false to true`~~
