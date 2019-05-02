<?php 
    $username = "root";
    $password = "";
    $database = "inventory_barang";
    $hostname = "localhost";
    $conn = mysqli_connect($hostname,$username,$password,$database) or die("Connection Corrupt");

    /**
    * 
    */
    class oop
    {
        
        public function login($username,$password,$level)
        {
                global $conn;
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $level;
                $sql = "SELECT * FROM table_user WHERE username ='$username' AND password = '$password'";
                $query = mysqli_query($conn,$sql);
                $rows  = mysqli_num_rows($query);
                $assoc = mysqli_fetch_assoc($query);
                if($rows > 0){
                    if ($assoc['level'] == "Admin" && $level == "Admin") {
                        echo "<script>alert('Selamat Datang Admin');document.location.href='admin.php'</script>";
                    }elseif ($assoc['level'] == "Kasir" && $level == "Kasir") {
                        echo "<script>alert('Selamat Datang Kasir');document.location.href='kasir.php'</script>";
                    }elseif ($assoc['level'] == "Manager" && $level == "Manager") {
                            echo "<script>alert('Selamat Datang Manager');document.location.href='manager.php'</script>";
                    }else{
                        echo "<script>alert('Hak Akses Salah');document.location.href='index.php'</script>";
                    }
                }else{
                    echo "<script>alert('Username atau Password Salah');document.location.href='index.php'</script>";
            }

        }


        public function simpan($table,$values,$form){
            global $conn;
            
            $sql   ="INSERT INTO $table VALUES($values)";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "<script>alert('Berhasil Simpan Data');document.location.href='$form'</script>";
            }else{
                echo "<script>alert('Gagal simpan data'".mysqli_error($conn).");;document.location.href='$form'</script>";
            }
        }

        public function select($table){
            global $conn;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        public function kode_auto($table,$where,$pre){
            global $conn;
            $cek_kode = mysqli_query($conn, "select max($where) from $table");
            @$data = mysqli_fetch_array($cek_kode);
            if ($data) {
                $nilaikode = substr($data[0], 1);
                $kode = (int) $nilaikode;
                $kode = $kode + 1;
                $kode_otomatis = "$pre".str_pad($kode, 4, "0", STR_PAD_LEFT);
            } else {
                $kode_otomatis = $pre."0001";
            }
            return $kode_otomatis;
        }
        

        function validateImage(){
            global $con;
            $name       = $_FILES['foto']['name']; 
            $ukuranFile = $_FILES['foto']['size']; 
            $error      = $_FILES['foto']['error']; 
            $tmpName    = $_FILES['foto']['tmp_name']; 
            
            $folder = 'img/'; 

            $ekstensiGambar = explode('.',$name); 
            $namaGambar = $ekstensiGambar[0]; 
            $ekstensiBelakang = strtolower(end($ekstensiGambar)); 
            $ekstensi = ['jpg','jpeg','png']; 
            $error = array(); 

                if (in_array($ekstensiBelakang, $ekstensi) === false) { 
                     echo "<script>alert('Gambar hanya boleh menggunakan ekstensi jpg,jpeg,png')</script>";
                }

                if ($ukuranFile > 4000000) { 
                    echo "<script>alert('Ukuran Gambar Terlalu besar')</script>"; 
                }


            if (empty($errors)) {
                if (!file_exists('img')) { 
                    mkdir('img',0563);
                }
                
            }
            $name = random_int(1, 999);
            $name = time().$name.".".$ekstensiBelakang;
            move_uploaded_file($tmpName, $folder.$name); 

            return ['types'=>'true','image'=>$name];
        }
        

        public function delete($table, $where, $whereValues, $form){
            global $conn;
            $sql = "DELETE FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            if ($query) {
                echo "<script>alert('Berhasil Didelete');document.location.href='$form'</script>";
            }
            else{
                echo "<script>alert('Gagal Delete". mysqli_error($conn) ."');document.location.href='$form'</script>";
            }
        }


        public function edit($table,$where, $whereValues){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while ($bigData = mysqli_fetch_assoc($query)) {
                $data[] = $bigData;
            }
            return $data;
        }

        public function update($table,$values,$where,$whereValuesedit,$form){
            global $conn;
            $sql   = "UPDATE $table SET $values WHERE $where = '$whereValuesedit'";
            $query = mysqli_query($conn,$sql);
                if($query){
                    echo "<script>alert('Data Berhasil diubah');document.location.href='$form'</script>";
                }else{
                    echo mysqli_error($conn);
                    echo "<script>alert('Data Berhasil diubah');document.location.href='$form'</script>";
                }
        }

        public function querySelect($sql){
            global $conn;
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }


        public function selectCount($table,$namaField){
            global $conn;
            $sql = "SELECT COUNT($namaField) as count FROM $table";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectWhere($table,$where,$whereValues){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }


        public function jumlah($table,$where){
            global $conn;
            $sql = "SELECT COUNT($where) FROM $table";
            $query = mysqli_query($conn, $sql);
        }

         public function selectMax($table,$namaField){
            global $conn;
            $sql = "SELECT MAX($namaField) as max FROM $table";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectMin($table,$namaField){
            global $conn;
            $sql = "SELECT MIN($namaField) as min FROM $table";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectSum($table,$namaField){
            global $conn;
            $sql = "SELECT SUM($namaField) as sum FROM $table";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectSumWhere($table,$namaField,$where){
            global $conn;
            $sql = "SELECT SUM($namaField) as sum FROM $table WHERE $where";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }


        public function selectCountWhere($table,$namaField,$where){
            global $conn;
            $sql = "SELECT COUNT($namaField) as count FROM $table WHERE $where";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectAvg($table,$namaField){
            global $conn;
            $sql = "SELECT AVG($namaField) as avg FROM $table";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectBetween($table,$whereparam,$param,$param1){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $query = mysqli_query($conn,$sql);

            $sqls = "SELECT SUM(stok_barang) as count FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $querys = mysqli_query($conn,$sqls);
            $assocs = mysqli_fetch_assoc($querys);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return ['data'=>$data,'jumlah'=>$assocs];
        }

        
        public function search($table,$likeKey,$likeOne){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $likeKey like '%$likeOne%'";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;

        }

        public function AuthUser($sessionUser){
            global $conn;
            $sql = "SELECT * FROM table_user WHERE username = '$sessionUser'";
            $query = mysqli_query($conn,$sql);
            $bigData = mysqli_fetch_assoc($query);
            return $bigData;
        }

        public function sessionCheck(){
            if(!isset($_SESSION['username'])){
                return "false";
            }else{
                
                return "true";
            }
        }

        public function logout(){
            session_destroy();
            header("Location:index.php");
        }

    }

?>