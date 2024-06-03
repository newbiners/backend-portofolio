# php backend

ini adalah project php + docker untuk backend portofolio saya yang menerapkan sistem mvc dimana akan ada endpoint :
- login
- create user
- comment community
- tempat mengirimkan pesan ke email saya

### required
- anda harus menginstall docker terleboh dahulu

## cara installasi

- buat file .env
- jalankan printah "docker-compose  up -d --build" untuk membuat container
- jalankan printah "composer install" untuk menginstall semua package
- masukan beberapa variabel yang harus dimasukan didalam file env
-   - HOST_NAME = "host name"
-   - USER_NAME = "user name"
-   - PASSWORD = "password"
-   - DATA_BASE = "data base"
-   - PASSWORD_EMAIL = 'password email'
-   - EMAIL_USER = 'user email'


