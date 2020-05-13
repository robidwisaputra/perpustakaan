<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Anggota</h3>
      </div>
      <div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksi') ;?>"></div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Total : <?= $total ;?></h2>
            <a href="<?= base_url() ;?>anggota/tambah" class="btn btn-sm btn-primary float-right">Tambah Data</a>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

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
                    <td class=" "><?= $i++ ;?> </td>
                    <td class=" "><?= $row->nama_anggota ;?> </td>
                    <td class=" "><?= $row->alamat ;?> </td>
                    <td class=" "><?= $row->telepon ;?></td>
                    <td class=" "><?= $row->status_anggota ;?></td>
                    <td class=" last">
                    	<a href="<?= base_url() ;?>anggota/ubah/<?= $row->id_anggota ;?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
											<a href="<?= base_url() ;?>anggota/hapus/<?= $row->id_anggota ;?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                    </td>
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