<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'barang' => [
        'name' => 'Barang',
        'index_title' => 'Daftar Barang',
        'new_title' => 'Barang Baru',
        'create_title' => 'Tambah Barang',
        'edit_title' => 'Edit Barang',
        'show_title' => 'Tampilkan Barang',
        'inputs' => [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'satuan' => 'Satuan',
            'harga_jual' => 'Harga Jual',
            'stok' => 'Stok',
            'ditarik' => 'Ditarik',
            'user_id' => 'User',
            'produk_id' => 'Produk',
        ],
    ],

    'detail_penjualan' => [
        'name' => 'Detail Penjualan',
        'index_title' => 'Daftar Detail Penjualan',
        'new_title' => 'Detail Penjualan Baru',
        'create_title' => 'Tambah Detail Penjualan',
        'edit_title' => 'Edit Detail Penjualan',
        'show_title' => 'Tampilkan Detail Penjualan',
        'inputs' => [
            'harga_jual' => 'Harga Jual',
            'jumlah' => 'Jumlah',
            'sub_total' => 'Sub Total',
            'penjualan_id' => 'Penjualan',
            'barang_id' => 'Barang',
        ],
    ],

    'detail_transaksi' => [
        'name' => 'Detail Transaksi',
        'index_title' => 'Daftar Detail Transaksi',
        'new_title' => 'Detail Transaksi Baru',
        'create_title' => 'Tambah Detail Transaksi',
        'edit_title' => 'Edit Detail Transaksi',
        'show_title' => 'Tampilkan Detail Transaksi',
        'inputs' => [
            'jumlah_bayar' => 'Jumlah Bayar',
            'transaksi_id' => 'Transaksi',
            'jenis_pembayaran_id' => 'Jenis Pembayaran',
        ],
    ],

    'jenis_pembayaran' => [
        'name' => 'Jenis Pembayaran',
        'index_title' => 'Daftar Jenis Pembayaran',
        'new_title' => 'Jenis Pembayaran Baru',
        'create_title' => 'Tambah Jenis Pembayaran',
        'edit_title' => 'Edit Jenis Pembayaran',
        'show_title' => 'Tampilkan Jenis Pembayaran',
        'inputs' => [
            'nama' => 'Nama',
        ],
    ],

    'pelanggan' => [
        'name' => 'Pelanggan',
        'index_title' => 'Daftar Pelanggan',
        'new_title' => 'Pelanggan Baru',
        'create_title' => 'Tambah Pelanggan',
        'edit_title' => 'Edit Pelanggan',
        'show_title' => 'Tampilkan Pelanggan',
        'inputs' => [
            'kode_pelanggan' => 'Kode Pelanggan',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'email' => 'Email',
        ],
    ],

    'pemasok' => [
        'name' => 'Pemasok',
        'index_title' => 'Daftar Pemasok',
        'new_title' => 'Pemasok Baru',
        'create_title' => 'Tambah Pemasok',
        'edit_title' => 'Edit Pemasok',
        'show_title' => 'Tampilkan Pemasok',
        'inputs' => [
            'nama_pemasok' => 'Nama Pemasok',
        ],
    ],

    'pembelian' => [
        'name' => 'Pembelian',
        'index_title' => 'Daftar Pembelian',
        'new_title' => 'Pembelian Baru',
        'create_title' => 'Tambah Pembelian',
        'edit_title' => 'Edit Pembelian',
        'show_title' => 'Tampilkan Pembelian',
        'inputs' => [
            'kode_masuk' => 'Kode Masuk',
            'tanggal_masuk' => 'Tanggal Masuk',
            'total' => 'Total',
            'pemasok_id' => 'Pemasok',
            'user_id' => 'User',
        ],
    ],

    'penjualan' => [
        'name' => 'Penjualan',
        'index_title' => 'Daftar Penjualan',
        'new_title' => 'Penjualan Baru',
        'create_title' => 'Tambah Penjualan',
        'edit_title' => 'Edit Penjualan',
        'show_title' => 'Tampilkan Penjualan',
        'inputs' => [
            'no_faktur' => 'No Faktur',
            'tgl_faktur' => 'Tgl Faktur',
            'total_bayar' => 'Total Bayar',
            'pelanggan_id' => 'Pelanggan',
            'user_id' => 'User',
        ],
    ],

    'produk' => [
        'name' => 'Produk',
        'index_title' => 'Daftar Produk',
        'new_title' => 'Produk Baru',
        'create_title' => 'Tambah Produk',
        'edit_title' => 'Edit Produk',
        'show_title' => 'Tampilkan Produk',
        'inputs' => [
            'nama_produk' => 'Nama Produk',
        ],
    ],

    'rombel' => [
        'name' => 'Rombel',
        'index_title' => 'Daftar Rombel',
        'new_title' => 'Rombel Baru',
        'create_title' => 'Tambah Rombel',
        'edit_title' => 'Edit Rombel',
        'show_title' => 'Tampilkan Rombel',
        'inputs' => [
            'rombel' => 'Rombel',
        ],
    ],

    'transaksi' => [
        'name' => 'Transaksi',
        'index_title' => 'Daftar Transaksi',
        'new_title' => 'Transaksi Baru',
        'create_title' => 'Tambah Transaksi',
        'edit_title' => 'Edit Transaksi',
        'show_title' => 'Tampilkan Transaksi',
        'inputs' => [
            'kode_transaksi' => 'Kode Transaksi',
            'tgl_bayar' => 'Tgl Bayar',
            'user_input' => 'User Input',
            'rombel_id' => 'Rombel',
        ],
    ],

    'user' => [
        'name' => 'User',
        'index_title' => 'Daftar User',
        'new_title' => 'User Baru',
        'create_title' => 'Tambah User',
        'edit_title' => 'Edit User',
        'show_title' => 'Tampilkan User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'tampung_bayar' => [
        'name' => 'Tampung Bayar',
        'index_title' => 'Daftar Tampung Bayar',
        'new_title' => 'Tampung Bayar Baru',
        'create_title' => 'Tambah Tampung Bayar',
        'edit_title' => 'Edit Tampung Bayar',
        'show_title' => 'Tampilkan Tampung Bayar',
        'inputs' => [
            'penjualan_id' => 'Penjualan',
            'total' => 'Total',
            'terima' => 'Terima',
            'kembali' => 'Kembali',
        ],
    ],

    'detail_pembelian' => [
        'name' => 'Detail Pembelian',
        'index_title' => 'Daftar Detail Pembelian',
        'new_title' => 'Detail Pembelian Baru',
        'create_title' => 'Tambah Detail Pembelian',
        'edit_title' => 'Edit Detail Pembelian',
        'show_title' => 'Tampilkan Detail Pembelian',
        'inputs' => [
            'harga_beli' => 'Harga Beli',
            'jumlah' => 'Jumlah',
            'sub_total' => 'Sub Total',
            'pembelian_id' => 'Pembelian',
            'barang_id' => 'Barang',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
