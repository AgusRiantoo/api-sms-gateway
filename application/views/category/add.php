<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Siswa</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form action="<?php echo base_url('admin/siswa/store'); ?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label class="control-label">No Induk :</label>
                    <input type="text" name="no_induk" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Name :</label>
                    <input type="text" name="name" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Jenis Kelamin :</label>
                    <select class="form-control" name="jekel">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Alamat :</label>
                    <input type="text" name="alamat" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tanggal Lahir :</label>
                    <input type="date" name="ttl" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <center>
                    <button type="submit" name="submit" class="btn btn-success"> Submit </button>
                    </center>
                  </div>

                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content