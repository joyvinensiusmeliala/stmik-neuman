<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Jurusan</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Data Umum</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Daftar Jurusan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">
										 <a href="" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#addJurusan"><i class="fa fa-plus"></i> Tambah</a>
									</div>
								</div>
								<div class="card-body">
									
									<table class="table table-sm">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Kode Jurusan</th>
												<th scope="col">Nama Jurusan</th>
                                                <th scope="col">Kepala Prodi</th>
												<th scope="col">Opsi</th>
											</tr>
										</thead>
										<tbody>
                        <?php 
                        $no=1;
                        $jurusan = mysqli_query($con,"SELECT * FROM tb_jurusan 
                        INNER JOIN tb_dosen ON tb_jurusan.ka_prodi=tb_dosen.id_dosen
                        ");
                        foreach ($jurusan as $k) {?>

                        <?php
                        $dosen = mysqli_query($con,"SELECT * FROM tb_dosen 
                        -- INNER JOIN tb_dosen ON tb_jurusan.ka_prodi=tb_dosen.id_dosen
                        ");
                        foreach ($dosen as $dsn) 
                        ?>
                        <tr>
                            <td><b><?=$no++;?>.</b></td>                            
                            <td><?=$k['kd_jurusan'];?></td>
                            <td><?=$k['nama_jurusan'];?></td>
                            <td><?=$k['nama_dosen'];?></td>
                            <td>
                                
                            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$k['id_jurusan'] ?>"><i class="far fa-edit"></i> Edit</a>
                            <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=master&act=deljurusan&id=<?=$k['id_jurusan'] ?>"><i class="fas fa-trash"></i> Del</a>

                            <!-- Modal -->
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?=$k['id_jurusan'] ?>" class="modal fade" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Edit Jurusan</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                          <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Nama Jurusan</label>
                                                    <input name="id" type="hidden" value="<?=$k['id_jurusan'] ?>">
                                                    <input name="jurusan" type="text" value="<?=$k['nama_jurusan'] ?>" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Dosen</label>
                                                    <!-- <input name="kurikulum" type="text" placeholder="Nama Kurikulum .." class="form-control"> -->
                                                    <select class="form-control" name="ka_prodi">
                                                    <option>Pilih Kepala Prodi</option>
                                                    <?php
                                                    $sqlDosen=mysqli_query($con, "SELECT * FROM tb_dosen 
                                                    ORDER BY id_dosen ASC");
                                                    while($dsn=mysqli_fetch_array($sqlDosen)){

                                                        if ($dsn['id_dosen']==$dsn['id_dosen']) {
                                                            $selected= "selected";
                                                            
                                                          }else{
                                                            $selected='';
                                                          }
                                                        
                                                        
                                                    echo "<option value='$dsn[id_dosen]'>$dsn[nama_dosen]</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>            
                                            <div class="form-group">                    
                                                    <button name="edit" class="btn btn-primary" type="submit">Edit</button>
                                             
                                            </div>                        
                                            </div>                      
                                          </div>
                                        </form>
                                        <?php 
                                        if (isset($_POST['edit'])) {
                                            $save= mysqli_query($con,"UPDATE tb_jurusan SET nama_jurusan='$_POST[jurusan]', ka_prodi='$_POST[ka_prodi]' WHERE id_jurusan='$_POST[id]' ");
                                            if ($save) {
                                                echo "<script>
                                                alert('Data diubah !');
                                                window.location='?page=master&act=jurusan';
                                                </script>";                        
                                            }
                                        }

                                         ?>


                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->



                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>      
									</table>
								</div>
							</div>



							<!-- Modal -->
<div id="addJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Tambah Jurusan</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label>Kode Jurusan</label>
                        <input name="kode" type="text" value="KL-<?=time();?>" class="form-control" readonly>
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <input name="jurusan" type="text" placeholder="Nama Jurusan .." class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Dosen</label>
                        <!-- <input name="kurikulum" type="text" placeholder="Nama Kurikulum .." class="form-control"> -->
                        <select class="form-control" name="ka_prodi">
                        <option>Pilih Kepala Prodi</option>
                        <?php
                        $sqlDosen=mysqli_query($con, "SELECT * FROM tb_dosen 
                        ORDER BY id_dosen ASC");
                        while($dsn=mysqli_fetch_array($sqlDosen)){ 
                            
                        echo "<option value='$dsn[id_dosen]'>$dsn[nama_dosen]</option>";
                        }
                        ?>
                        </select>
                    </div>  
                   
                    <div class="form-group">                     
                            <button name="save" class="btn btn-primary" type="submit">Simpan</button>
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Batal</button>
                    </div>
                </form>
                <?php 
                if (isset($_POST['save'])) {
                   
                    $save= mysqli_query($con,"INSERT INTO tb_jurusan VALUES(NULL,'$_POST[kode]','$_POST[jurusan]','$_POST[ka_prodi]') ");
                    if ($save) {
                        echo "<script>
                        alert('Data tersimpan !');
                        window.location='?page=master&act=jurusan';
                        </script>";                        
                    }
                }

                 ?>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

				</div>
			</div>
		</div>

	</div>
</div>
</div>
</div>
</div>
</div>
</div>

