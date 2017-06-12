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
                    <h2>Update Product</h2>
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

                  <div class="form-group">
                    <label class="control-label">Select Category :</label>
                    <select class="form-control" name="category">
                      <?php foreach ($category->result() as $rows) : ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Old Product Image :</label><br>
                    <img src="<?php echo base_url('uploads/'.$row->picture); ?>" height="250px">
                    <input type="hidden" name="old_file" value="<?php echo $row->picture ?>">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Product Image :</label>
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