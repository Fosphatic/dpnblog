# Changelog

## 1.0.5 Planning June 26, 2018 10:53 PM

### Error Found
- Admin paneldeki yeni kategori ekle butonuna `admin to @dpnblog` şeklinde değiştirilecek 404'e gidiyor. (views/admin/category-index | ** 16. line ** )
- posts sayfasında kategori linkleri çalışmıyor. Bunun sebebi index.php'deki 31. satırda. `false to true`
