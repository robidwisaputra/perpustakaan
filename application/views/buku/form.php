<?php 
$id = (isset($buku)) ? $buku->id_buku : null ; 
$judul = (isset($buku)) ? $buku->judul : null ; 
$jenis = (isset($buku)) ? $buku->jenis : null ; 
$pengarang = (isset($buku)) ? $buku->pengarang : null ; 
$penerbit = (isset($buku)) ? $buku->penerbit : null ; 
$stok = (isset($buku)) ? $buku->stok : null ; 

 ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= (isset($buku)) ? 'Ubah' : 'Tambah' ?> Data buku</h3>
      </div>
    </div>

    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
            	<h2>Form buku </h2>
            	<ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form action="<?= (isset($buku)) ? base_url().'buku/ubah/'.$buku->id_buku : base_url().'buku/tambah' ?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              	<input type="hidden" name="id" value="<?= $id ;?>">
                  
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Judul <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" name="judul" id="judul" class="form-control <?= (form_error('judul')) ? 'is-invalid' : '' ?>" value="<?= $judul ;?>">
                    <?= form_error("judul"); ?>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="jenis" value="jenis">Jenis <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="jenis" name="jenis"  class="form-control <?= (form_error('jenis')) ? 'is-invalid' : '' ?>" value="<?= $jenis ;?>">
                    <?= form_error("jenis"); ?>
                  </div>
                </div>               
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="pengarng">Pengarang <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input name="pengarang" id="pengarang" cols="3" rows="3" class="form-control <?= (form_error('pengarang')) ? 'is-invalid' : '' ?>" value="<?= $pengarang ;?>">
                    <?= form_error("pengarang"); ?>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="penerbit">Penerbit <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input name="penerbit" id="penerbit" cols="3" rows="3" class="form-control <?= (form_error('penerbit')) ? 'is-invalid' : '' ?>" value="<?= $penerbit ;?>">
                    <?= form_error("penerbit"); ?>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="stok" value="stok">Stok <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="stok" name="stok"  class="form-control <?= (form_error('stok')) ? 'is-invalid' : '' ?>" value="<?= $stok ;?>">
                    <?= form_error("stok"); ?>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="stok" value="stok">Gambar <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="file" id="stok" name="gambar"  class="form-control <?= (form_error('stok')) ? 'is-invalid' : '' ?>" value="<?= $stok ;?>">
                    <?= form_error("stok"); ?>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                  <div class="col-md-6 col-sm-6 offset-md-3">
                    <a href="<?= base_url() ;?>buku" class="btn btn-primary">Cancel</a>
			  						<button class="btn btn-warning" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>