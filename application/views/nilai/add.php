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
                    <h2>Add Product</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form action="<?php echo base_url('admin/nilai/store'); ?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label class="control-label">Pilih Siswa :</label>
                    <select class="form-control" name="no">
                      <?php foreach ($category->result() as $row) : ?>
                        <option value="<?php echo $row->no_induk; ?>"><?php echo $row->nama; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Pilih Mata Pelajaran :</label>
                    <select class="form-control" name="kdmp">
                      <?php foreach ($category2->result() as $row2) : ?>
                        <option value="<?php echo $row2->kode; ?>">
                        <?php echo $row2->nama." - Kelas : ".$row2->kelas." - Semester : ".$row2->semester; ?>
                          
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Nilai :</label>
                    <input type="text" name="nilai" required="required" class="form-control">
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