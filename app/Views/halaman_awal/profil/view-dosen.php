  <!-- About tab start -->
  <div class="tab-pane">
      <div class="row">
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-header">
                      <center>
                          <h5 class="card-header-text">Informasi Dosen</h5>
                      </center>
                      <hr>
                      <!-- <button id="edit-btn" type="button" class="btn btn-primary waves-effect waves-light f-right">
                          <i class="icofont icofont-edit"></i>
                      </button> -->
                  </div>
                  <div class="card-block">
                      <div id="view-info" class="row">
                          <div class="col-lg-6 col-md-12">
                              <form>
                                  <table class="table table-responsive m-b-0">
                                      <tr>
                                          <th class="social-label b-none p-t-0">Nama Lengkap
                                          </th>
                                          <td class="social-user-name b-none p-t-0 text-muted"><?= $profil['nama_dosen'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">NIP</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['nip'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Jenis Kelamin</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['jk'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Telepon</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['telepon'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Alamat</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['alamat'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Email</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['email'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Status Ajar</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['status_ajar'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Fakultas</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['fakultas'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Program Studi</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['program_studi'] ?></td>
                                      </tr>
                                      <tr>
                                          <th class="social-label b-none">Status Dosen</th>
                                          <td class="social-user-name b-none text-muted"><?= $profil['nama_status'] ?></td>
                                      </tr>
                                  </table>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- About tab end -->