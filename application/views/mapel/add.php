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
                    <h2>Tambah Mata Pelajaran</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form action="<?php echo base_url('admin/mapel/store'); ?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label class="control-label">Kode :</label>
                    <input type="text" name="kode" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Mata Pelajaran :</label>
                    <input type="text" name="mapel" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Kelas :</label>
                    <input type="text" name="kelas" required="required" class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Semester :</label>
                    <input type="text" name="semester" required="required" class="form-control">
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