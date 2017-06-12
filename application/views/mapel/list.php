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
                    <h2>Daftar Mata pelajaran</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-striped">
                        <thead>
                          <th>Kode</th>
                          <th>Mata Pelajaran</th>
                          <th>Kelas</th>
                          <th>Semester</th>
                          <th></th>
                        </thead>
                        <tbody>
                        <?php foreach ($query->result() as $row) { ?>
                          <tr>
                            <td><?php echo $row->kode; ?></td>
                            <td><?php echo $row->nama; ?></td>
                            <td><?php echo $row->kelas; ?></td>
                            <td><?php echo $row->semester; ?></td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="<?php echo base_url('admin/category/delete/'.$row->kode); ?>">Delete</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>

                      <p>Total Siswa : <?php echo $query->num_rows(); ?></p>

                      <div class="form-group">
                          <a href="<?php echo base_url('admin/mapel/add'); ?>" class="btn btn-success">
                          Tambah Mata Pelajaran
                          </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
