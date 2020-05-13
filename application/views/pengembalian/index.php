

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Pengembalian</h3>
      </div>
      <div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksi') ;?>"></div>
    </div>

    <div class="clearfix"></div>
    <form action="<?= base_url() ;?>pengembalian/tambah" method="post">
    <div class="row">
      <div class="col-md-6">
        <div class="x_panel shadow">
          <div class="x_content">
            <div class="form-group">
              <label for="tanggal">Tanggal Pinjam</label>
              <input type="text" class="form-control" id="tanggal-pinjam" name="tanggalPinjam" readonly="readonly">
            </div>
            <div class="form-group">
              <label for="tanggalKembali">Tanggal Kembali</label>
              <input type="text" class="form-control" id="tanggalKembali" name="tanggalKembali" readonly="readonly" value="<?= $tanggal ;?>">
            </div>
          </div>
        </div>

        <div class="x_panel shadow">
          <div class="x_title">
            <h2>Anggota </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?= form_error('nama_anggota') ;?>
            <div class="input-group mb-3">
              <input type="text" class="form-control nama_anggota <?= (form_error('nama_anggota')) ? 'is-invalid' : '' ?>" readonly="readonly" name="nama_anggota">
              <div class="input-group-append">
                <button class="btn btn-secondary" type="button" id="cari-anggota" data-toggle="modal" data-target="#modalAnggota">Cari</button>
              </div>
            </div>
            <div class="input-group mb-3">
              <h6 class="col-sm-3"><b>Status</b></h6><b>:</b>
              <div class="col-sm-8">
                <h6 class="status_anggota"></h6>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-6">

        <div class="x_panel shadow">
          <div class="x_title">
            <h2>Buku</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li> 
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="input-group mb-3">
              <h6 class="col-sm-3"><b>Judul</b></h6><b>:</b>
              <div class="col-sm-8">
                <h6 id="judul"></h6>
              </div>
            </div>
            <div class="input-group mb-3">
              <h6 class="col-sm-3"><b>Jenis</b></h6><b>:</b>
              <div class="col-sm-8">
                <h6 id="jenis"></h6>
              </div>
            </div>
            <div class="input-group mb-3">
              <h6 class="col-sm-3"><b>Pengarang</b></h6><b>:</b>
              <div class="col-sm-8">
                <h6 id="pengarang"></h6>
              </div>
            </div>
            <div class="input-group mb-3">
              <h6 class="col-sm-3"><b>Penerbit</b></h6><b>:</b>
              <div class="col-sm-8">
                <h6 id="penerbit"></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="x_panel shadow">
          <div class="x_content">
              <input type="hidden" id="id_anggota" name="id_anggota">
              <input type="hidden" id="id_pengembalian" name="id_pengembalian" value="<?= $id_pengembalian ;?>">
              <input type="hidden" id="id_peminjaman" name="id_peminjaman">
              <input type="hidden" id="id_buku" name="id_buku">
              <input type="hidden" id="id_user" name="id_user" value="<?= $this->session->userdata('id_user') ;?>">
              <button class="btn btn-secondary col-md-12 shadow">Simpan</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<!-- Modal Anggota -->
<div class="modal fade" id="modalAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th class="column-title"># </th>
                <th class="column-title">Nama </th>
                <th class="column-title">Alamat </th>
                <th class="column-title">Telepon </th>
                <th class="column-title">Status </th>
                <th class="column-title no-link last"><span class="nobr">Aksi</span>
                </th>
                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <?php $i = 1; 
              foreach ($anggota as $row): ?>
              <tr class="even pointer">
                <td class="d-none"><?= $row->id_anggota ;?></td>
                <td class=" "><?= $i++ ;?> </td>
                <td class=" "><?= $row->nama_anggota ;?> </td>
                <td class=" "><?= $row->alamat ;?> </td>
                <td class=" "><?= $row->telepon ;?></td>
                <td class=" "><?= $row->status_anggota ;?></td>
                <td class=" last">
                  <button class="btn btn-sm btn-primary pilih-anggota-pengembalian" type="button">Pilih</button>
                </td>
              </tr>
              <?php endforeach ?> 
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>