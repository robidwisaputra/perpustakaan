<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Laporan Pengembalian</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <a href="<?= base_url() ;?>Laporan_pengembalian/export" class="btn btn-sm btn-success">Export ke Excel</a>
            <a href="<?= base_url() ;?>Laporan_pengembalian/pdf" class="btn btn-sm btn-danger">Export ke Pdf</a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <h3 align="center">Data Pengembalian</h3><br>
            <div class="col-md-1"></div>
            <div class="table-responsive col-md-10">
              <table class="table table-bordered">
                <thead>
                  <tr class="headings">
                    <th class="column-title">No </th>
                    <th class="column-title">Nama Anggota </th>
                    <th class="column-title">Buku </th>
                    <th class="column-title">Tanggal Pinjam </th>
                    <th class="column-title">Tanggal Pengembalian </th>
                    <th class="column-title no-link last"><span class="nobr">Petugas</span> </th>
                    <th class="bulk-actions" colspan="7">
                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                  </tr>
                </thead>

                <tbody>
                  <?php $i = 1; 
									foreach ($pengembalian as $row): ?>
                  <tr class="even pointer">
                    <td class=" "><?= $i++ ;?> </td>
                    <td class=" "><?= $row->nama_anggota ;?> </td>
                    <td class=" "><?= $row->judul ;?> </td>
                    <td class=" "><?= $row->tgl_pinjam ;?></td>
                    <td class=" "><?= $row->tgl_pengembalian ;?></td>
                    <td class=" "><?= $row->nama_petugas ;?></td>
                  </tr>
                	<?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>