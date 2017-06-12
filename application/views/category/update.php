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
                    <h2>Update Category</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form action="" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label class="control-label">Name :</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row->name ?>" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Description :</label>
                    <textarea name="description" class="form-control" placeholder="Masukan isi">
                      <?php echo $row->description; ?>
                    </textarea>
                  </div>

                  <?php if ($row->banner != 'default.jpg'): ?>
                  <div class="form-group">
                    <label class="control-label">Old Banner :</label><br>
                    <img src="<?php echo base_url('uploads/'.$row->banner); ?>" height="250px">
                  </div>
                  <?php endif ?>

                  <div class="form-group">
                    <label class="control-label">Update Banner :</label>
                    <input type="hidden" name="old_file" value="<?php echo $row->banner ?>">
                    <input type="file" name="input_file" class="control-file">
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