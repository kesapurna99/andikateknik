<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Pelanggan</td>
            <td>No Hp</td>
            <td>Alamat</td>
            <td>Tanggal Pengerjaan</td>
            <td>Pesanan</td>
            <td>Total Biaya</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'koneksi.php';
            $no = 1;
            $query = "SELECT * FROM transaksi ORDER BY id DESC";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    $id = $row['id'];
                    $nama = $row['nama'];
                    $no_hp = $row['no_hp'];
                    $alamat = $row['alamat'];
                    $tgl_pengerjaan = $row['tgl_pengerjaan'];
                    $pesanan = $row['pesanan'];
                    $total_biaya = $row['total_biaya'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama; ?></td>
                <td><?php echo $no_hp; ?></td>
                <td><?php echo $alamat; ?></td>
                <td><?php echo $tgl_pengerjaan; ?></td>
                <td><?php echo $pesanan; ?></td>
                <td><?php echo $total_biaya; ?></td>
                
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    
    function reset(){
        document.getElementById("err_nama").innerHTML = "";
        document.getElementById("err_no_hp").innerHTML = "";
        document.getElementById("err_alamat").innerHTML = "";
        document.getElementById("err_tgl_pengerjaan").innerHTML = "";
        document.getElementById("err_pesanan").innerHTML = "";
    }

    $(document).on('click', '.edit_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "get_data.php",
            data: {id:id},
            dataType:'json',
            success: function(response) {
                reset();
                document.getElementById("id").value = response.id;
                document.getElementById("nama").value = response.nama;
                document.getElementById("no_hp").value = response.no_hp;
                document.getElementById("alamat").value = response.alamat;
                document.getElementById("tgl_pengerjaan").value = response.tgl_pengerjan;
                document.getElementById("pesanan").value = response.pesanan;
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "hapus_data.php",
            data: {id:id},
            success: function() {
                $('.data').load("data.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>