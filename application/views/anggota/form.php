<?php 
$id = (isset($anggota)) ? $anggota->id_anggota : null ; 
$nama = (isset($anggota)) ? $anggota->nama_anggota : null ; 
$alamat = (isset($anggota)) ? $anggota->alamat : null ; 
$telepon = (isset($anggota)) ? $anggota->telepon : null ; 
if(isset($anggota))  
	($anggota->status_anggota == 'guest') ? $guest = ['checked', 'active'] : $guest =  null;  
	else $guest =  ['checked', 'active'];

if(isset($anggota))  
	($anggota->status_anggota == 'member') ? $member = ['checked', 'active'] : $member =  null;  
	else $member =  [null, null];
 ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= (isset($anggota)) ? 'Ubah' : 'Tambah' ?> Data Anggota</h3>
      </div>
    </div>

    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
            	<h2>Form Anggota </h2>
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
              <form action="<?= (isset($anggota)) ? base_url().'anggota/ubah/'.$anggota->id_anggota : base_url().'anggota/tambah' ?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              	<input type="hidden" name="id" value="<?= $id ;?>">

                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">Nama <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" name="nama" id="nama" class="form-control <?= (form_error('nama')) ? 'is-invalid' : '' ?>" value="<?= $nama ;?>">
                    <?= form_error("nama"); ?>
                  </div>
                </div>                
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="telepon" value="telepon">Telepon <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="telepon" name="telepon"  class="form-control <?= (form_error('telepon')) ? 'is-invalid' : '' ?>" value="<?= $telepon ;?>">
                    <?= form_error("telepon"); ?>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="telepon">Alamat <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <textarea name="alamat" id="alamat" cols="3" rows="3" class="form-control <?= (form_error('alamat')) ? 'is-invalid' : '' ?>"><?= $alamat ;?></textarea>
                    <?= form_error("alamat"); ?>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
                  <div class="col-md-6 col-sm-6 ">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                    	<label class="btn btn-secondary <?= $guest[1] ;?>" >
                        <input type="radio" class="join-btn" name="status" id="status" value="guest" <?= $guest[0] ;?>> Guest
                      </label>
                      <label class="btn btn-secondary <?= $member[1] ;?>">
                        <input type="radio" class="join-btn" name="status" id="status" value="member"<?= $member[0] ;?>> Member
                      </label>
                    </div>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                  <div class="col-md-6 col-sm-6 offset-md-3">
                    <a href="<?= base_url() ;?>anggota" class="btn btn-primary">Cancel</a>
			  						<button class="btn btn-primary" type="reset">Reset</button>
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