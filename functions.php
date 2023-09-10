<?Php
// coneksikan dulu ke mysqli database
$kaii = mysqli_connect("localhost", "root", "", "aksara respect");
// ambil data dari tabel member | query data member |tek lebokna variable ben pendek

function query($query) {
    global $kaii;
    $result = mysqli_query($kaii, $query); #lemari
    $rowwdh = []; #wadah kosong
    while ($rowbju = mysqli_fetch_assoc($result) ) {
        $rowwdh [] = $rowbju; #ambil baju simpen wadah  
    }
    return $rowwdh;
}

function changedett($DataPost){
    global $kaii;

    $nick = htmlspecialchars ($DataPost ["nick_name"]);
    $idsv = htmlspecialchars ($DataPost ["id_server"]);
    $roll = htmlspecialchars ($DataPost ["rollers"]);
    $cont = htmlspecialchars ($DataPost ["contact"]);

    // upload profil gmbar
    $prof = upload ();
     if ( !$prof )
        {
            return false;
        }
    // query insert data 
    $query = "INSERT INTO member 
                VALUES 
            ('', '$nick', '$idsv', '$roll', '$cont', '$prof')";

    mysqli_query($kaii, $query);

    return mysqli_affected_rows($kaii); #kalo gagal -1 klo brasil 1
}

function upload(){
    $namaFile = $_FILES['profil']['name'];
    $ukuranFile = $_FILES['profil']['size'];
    $error = $_FILES['profil']['error'];
    $tmpName = $_FILES['profil']['tmp_name'];
    // cek apakah tdk ada gmbr yang di upload 4 adalah pesan gagal
    if ( $error === 4 ) {
        echo "<script>
                alert ('pilih gambar terlebih dahulu');
             </script>";
        return false;
    }
    //  cek apaakah yg di upload adalah gambar #jajal bae karo pdf :v
    // #explode itu pecah string #pake end biar ambil paling blakang
    //  strtolower paksa huruf kecil
    // in_array (needle (jarum),haystack (jerami)) mencari jarum dalm jerami

    $ekstensiGambarValid = ['jpg', 'jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "<script>
                alert (' udu gambar ya ngab ');
             </script>";
        return false;
    }
    //  cek jika ukurannya terlalu besar 500kb
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert (' kegedean gambar mu ngab lah');
             </script>";
        return false;
    }
    // nek lolos pngecheckan , gmbr siap di upload
    // generate nama gambar ben ora ana nama kembar saling menimpa
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // var_dump($namaFileBaru); die;
    // string(17) "61146e28bd670.jpg" hasil nama baru 
    move_uploaded_file($tmpName, 'proff/'. $namaFileBaru);
    return $namaFileBaru;
}

function editodata($DataPost){
    global $kaii;
     
    $id = $DataPost["id"];
    $nick = htmlspecialchars ($DataPost ["nick_name"]);
    $idsv = htmlspecialchars ($DataPost ["id_server"]);
    $roll = htmlspecialchars ($DataPost ["rollers"]);
    $cont = htmlspecialchars ($DataPost ["contact"]);
    $probien = $DataPost ["probien"];

    // check if user choose profil atau tidak
    if( $_FILES['profil']['error'] === 4 ){
        $prof = $probien;
    }else {
        $prof = upload();
    }
// !!!!!!!!!!! MASALAH DI edit saat tdk choose file baru.. if ny masih eror !!!!!!!!!!
    $query = "UPDATE member SET
                nick_name = '$nick',
                id_server = '$idsv',
                rollers = '$roll',
                contact = '$cont',
                profil = '$prof'
            WHERE id = $id
            ";
    
    mysqli_query($kaii, $query);

    return mysqli_affected_rows($kaii);
}

function deletedata($id) {
    global $kaii;
    mysqli_query($kaii, "DELETE FROM member WHERE id = $id");
    return mysqli_affected_rows($kaii);
}

function golet($singditulis){
    $query = " SELECT * FROM member
               WHERE 
               nick_name LIKE '%$singditulis%' OR
               id_server LIKE '%$singditulis%' OR
               rollers LIKE '%$singditulis%' OR
               contact LIKE '%$singditulis%'
               ";
        return query($query);
}

function registraseh($DataPost){
    global $kaii;

    $username = strtolower(stripslashes($DataPost["username"]) );
    $password = mysqli_real_escape_string($kaii,$DataPost["password"] );
    $konfirpass = mysqli_real_escape_string($kaii,$DataPost["konfirpass"] );

    // check username wis ana apa urung
   $result = mysqli_query($kaii, "SELECT username FROM user
                        WHERE username = '$username' ");
    if ( mysqli_fetch_assoc ($result) ){
        echo "
                <script>
                alert (' Username wis ana ngab !')
                </script> ";
                return false;
    }

    // check konfirmasi password
    if ( $password !== $konfirpass ) {
        echo "  <script>
                alert (' KONFIRMASI Password Tak Seseuai !')
                </script>
             ";
        return false;
    }
    // enkripsi password Dgn password_hash ($paswodte, algoritmane);
    $password = password_hash ($password, PASSWORD_DEFAULT);
    // var_dump($password); die;
    // string(60) "$2y$10$bW4h7rOwsfr84ilcnO4Hye6XHz0P4.QTkPRK20/Rx88lk0P5jSqDi"
    // hasil enkrip contone

    // tmbhkan userbaru ke databases 
    mysqli_query($kaii, "INSERT INTO user VALUES
                    ('', '$username', '$password') ");

    return mysqli_affected_rows($kaii); #1 ok -1 ggl

}

?>