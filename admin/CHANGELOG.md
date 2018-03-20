# Changelog
All notable changes to this project will be documented in this file.

## HELPDESK SBN

## Tanggal 10-01-2018
### Added
- Membuat list untuk log tools VM
https://172.16.79.194/software/beta/admin/network/log_tools_vm

## Tanggal 09-01-2018
### Changed
- Form cso untuk cek ARP customer
https://172.16.79.134/sbn/beta/cso/helpdesk/network/cek_arp
- Form untuk disable discovery neighbor
https://172.16.79.134/sbn/beta/admin/network/form_tools_vm

## Tanggal 23-12-2017
### Changed
- Update Monitoring OLT Customer, menambahkan group user untuk membedakan user GX dan SBN  pada 1 olt.
- Update Sistem Monitoring OLT, edit query untuk web SBN yg ditampilkan user SBN saja.

## Tanggal 19-12-2017
### Changed
- Update form master customer, menambahkan filter untuk ip pool apabila sudah penuh diberi peringatan pada saat memilih paket internet

## Tanggal 16-12-2017
### Changed
- Untuk sistem refill voip diganti ke menu VOIP > Payment

## Tanggal 15-12-2017
### Changed
- Menambahkan ip pool untuk SBN (10.210.1.0/24)

## Tanggal 13-12-2017
### Changed
- Update generate invoice bulanan, menambahkan email bcc ke info.sbn@globalxtreme.net dan sbn@globalxtreme.net

## Tanggal 12-12-2017
### Changed
- Edit Halaman VOIP di menu web CSO VOIP > Check Phone User
- Edit tabel master customer, menambahkan cHomePhone dan cGXTV
- Alur data customer voip (master customer -> master nomer telpon -> database VOIP)

## Tanggal 09-12-2017
### Changed
- Disable edit kode paket pada form customer
- Form upgrade dan downgrade, data paket digray jika status nonactive, otomatis edit kode paket pada master customer

## Tanggal 08-12-2017
### Added
- Master Paket, tambah field status(active-nonactive)

### Changed
- List master paket, tampilan gray untuk paket yang nonactive, halaman popup untuk detail paket
- Halaman Dasboard, Menampilkan total user aktif, user aktivasi, dan user bandwidth sesuai group bandwidth(10Mbps, 8Mbps, 5Mbps, 2Mbps)