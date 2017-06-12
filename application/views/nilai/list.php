        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Nilai</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-striped">
                        <thead>
                          <th>No Induk</th>
                          <th>Kode Mata Pelajaran</th>
                          <th>Nilai</th>
                          <th></th>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($query->result() as $row) { ?>
                          <tr>
                            <td><?php echo $row->no_induk; ?></td>
                            <td><?php echo $row->kdmp; ?></td>
                            <td><?php echo $row->nilai; ?></td>

                            <td>
                              <div class="btn-group">
                                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="<?php echo base_url('admin/product/delete/'.$row->id); ?>">Delete</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>

                      <center>
                       <!-- <ul class="pagination"> -->
                       <?php echo $this->pagination->create_links(); ?>
                      <!-- </ul>   -->
                      </center>

                      <div class="form-group">
                          <a href="<?php echo base_url('admin/nilai/add'); ?>" class="btn btn-success">
                          Tambah Nilai
                          </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content