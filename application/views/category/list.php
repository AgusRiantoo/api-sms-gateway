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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Siswa</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-striped">
                        <thead>
                          <th>No Induk</th>
                          <th>Name</th>
                          <th>Jenis Kelamin</th>
                          <th>Alamat</th>
                          <th>Tanggal Lahir</th>
                          <th></th>
                        </thead>
                        <tbody>
                        <?php foreach ($query->result() as $row) { ?>
                          <tr>
                            <td><?php echo $row->no_induk; ?></td>
                            <td><?php echo $row->nama; ?></td>
                            <td><?php echo $row->jekel; ?></td>
                            <td><?php echo $row->alamat; ?></td>
                            <td><?php echo $row->ttl; ?></td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="<?php echo base_url('admin/siswa/delete/'.$row->no_induk); ?>">Delete</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>

                      <p>Total Siswa : <?php echo $query->num_rows(); ?></p>

                      <div class="form-group">
                          <a href="<?php echo base_url('admin/siswa/add'); ?>" class="btn btn-success">
                          Tambah Siswa
                          </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->