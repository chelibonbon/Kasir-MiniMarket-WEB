<?php

namespace App\Controllers;
use App\Models\M_kasir;
use CodeIgniter\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function __construct()
    {
        $this->MKasir = new M_kasir(); // Initialize the model
    }
    public function login()
    {

        echo view('header');
        echo view('login');
    }
    public function aksi_login()
    {
            $recaptcha_secret = "6LeCA-8qAAAAABuno2XGm47dVSu9ifnffdncFeJR"; // Gunakan Secret Key reCAPTCHA
            $recaptcha_response = $this->request->getPost('g-recaptcha-response');

    // Jika reCAPTCHA tidak diisi
            if (!$recaptcha_response) {
                return redirect()->to('home/login')->with('error', 'Mohon isi reCAPTCHA.');
            }

    // Verifikasi reCAPTCHA dengan Google
            $verify_url = "https://www.google.com/recaptcha/api/siteverify";
            $response = file_get_contents($verify_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);

    // Pastikan hasil decode JSON tidak error
            $response_keys = json_decode($response, true);

            if (!isset($response_keys["success"]) || $response_keys["success"] !== true) {
                return redirect()->to('home/login')->with('error', 'Verifikasi reCAPTCHA gagal. Coba lagi.');
            }

        $username=$this->request->getPost('username');
        $password=$this->request->getPost('password');

        $MKasir= new M_kasir;
        $data = array(
            "username"=>$username,
            "password"=>md5($password)
        );
      // Check if the credentials exist

        $cek = $MKasir->getWhere('user', $data);

        // print_r($cek);
        // $cek uhh//
        // ini karena kitaa nyetak, harus menggunahkan echo, kalau error, karena di model tak ada Array akhirnya//
        if ($cek != null) {

            // ✅ General session data for all users
            $sessionData = [
                'id_user'   => $cek->id_user,
                'username'  => $cek->username,
                'nama_user' => $cek->nama_user,
                'level'     => $cek->level,
                'logged_in' => true
            ];

        // ✅ If user is kasir (level 2), store kasir details too
            if ($cek->level == 2) {
                $kasir = $MKasir->getWhere('kasir', ['id_user' => $cek->id_user]);
                if ($kasir) {
                    $sessionData['id_kasir']   = $kasir->id_kasir;
                    $sessionData['nama_kasir'] = $kasir->nama_kasir;
                }
            }

        // ✅ Set session (general + kasir if applicable)
            session()->set($sessionData);

              // ✅ Fetch nama_user from the user table
                $this->MKasir->insertLog("$cek->nama_user successfully logged in");
            return redirect ()->to('home/dashboard');
        }else{

                $this->MKasir->insertLog("Failed login attempt");

            session()->setFlashdata('error', 'invalid incredentials, Please try again.');
            return redirect ()->to('home/login');
        }
    }
    public function logout()
    {
        $nama_user = session()->get('nama_user');
            if ($nama_user) {
            $this->MKasir->insertLog("$nama_user logged out"); // ✅ Logs real nama_user
        }
        session()->destroy();
        return redirect ()->to('home/login');
    }
 public function forgot_password()
    {
        echo view ('header');
        echo view ('forgot_password');
    }

public function aksi_forgot_password()
{
    $MKasir = new M_kasir();
    $email = $this->request->getPost('email');

    // Check if the email exists in the database
    $user = $MKasir->getWhere('user', ['username' => $email]);

    if (!$user || !is_object($user)) {
        echo "No user found with this email.";
        return;
    }
    date_default_timezone_set('Asia/Jakarta');

    // Generate token and expiry
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", strtotime("+20 minutes"));

    // Save token to the database
    $MKasir->edit('user', [
        'token' => $token_hash,
        'expiry' => $expiry
    ], ['username' => $email]);

    // Reset link
    $resetLink = base_url("/home/aksi_reset_password?token=$token");

    // Create email content
    $subject = "Password Reset Request";
    $message = "
    <html>
    <head>
        <title>Password Reset Request</title>
    </head>
    <body>
        <p>Hey bucko.. i got you your mail here</p>
        <p>It seems like you've requested to reset your 'password', heres the link bellow</p>
        <p><a href='$resetLink' style='color: blue;'>Reset Password</a></p>
        <p>if this isnt from you requesting.. just ignore it, and ill take care of it, dont worry buddy</p>
        <p>from</p>
        <p>the punny skeleton, your safety security and owner of the grocery store</p>
    </body>
    </html>
    ";

    // Send the email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
           $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';   // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'chelsicachelsica@gmail.com';  // Your email
        $mail->Password   = 'enzh pbqa lnaf byhm';    // App password (NOT your real email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; 

        // Recipients
        $mail->setFrom('chelsicachelsica@gmail.com', 'Kasir MiniMarket local');
        $mail->addAddress($email);  


        // Content
        $mail->isHTML(true);                                
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $data['message'] = "A password reset link has been sent to your email.";
        $data['type'] = "success";
        return view('message_view', $data);
    } catch (Exception $e) {
        $data['message'] = "Failed to send email. Error: {$mail->ErrorInfo}";
        $data['type'] = "error";
        return view('message_view', $data);
    }
}

public function aksi_reset_password()
{
    $MKasir = new M_kasir();
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Hash the token from the URL

    date_default_timezone_set('Asia/Jakarta');
    // Validate the token
    $reset = $MKasir->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        return view('error_view', $data); // Render an error view
    }

    // Pass token to the view for the form
    $data['token'] = $token;
    return view('reset_password', $data); // Render the reset password view
}



public function update_password()
{
    $MKasir = new M_kasir();
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Ensure token is hashed consistently
    $password = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('confirm_password');

    if ($password !== $confirmPassword) {
        $data['message'] = "Passwords do not match.";
        $data['type'] = "error";
        return view('status_view', $data); // Render error view
    }

    // Set the correct timezone for comparison
    date_default_timezone_set('Asia/Jakarta');

    // Validate the token
    $reset = $MKasir->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        $data['type'] = "error";
        return view('status_view', $data); // Render error view
    }

    // Hash the new password
    $hashedPassword = md5($password);

    // Update the user's password
    $MKasir->edit('user', ['password' => $hashedPassword], ['username' => $reset->username]);

    // Delete the reset token
    $MKasir->edit('user', ['token' => null, 'expiry' => null], ['username' => $reset->username]);

    $data['message'] = "Your password has been updated successfully.";
    $data['type'] = "success";
    return view('status_view', $data); // Render success view
}
    public function log_activity()
    {
        if (session()->get('level')==1 ||  session()->get('level')==2 || session()->get('level')==3) {
         $level = session()->get('level');
         $nama_user = session()->get('nama_user');

         if ($level == 1 || $level == 3) {
        // ✅ Admin → show all logs
            $data['logs'] = $this->MKasir->getAllLogs();
        } elseif ($level == 2) {
        // ✅ Regular user → show only their logs
            $data['logs'] = $this->MKasir->getUserLogs($nama_user);
        } else {
        // ✅ If user is not logged in or unauthorized → redirect
            if ($level > 0) {
                return redirect()->to('home/error');
            } else {
                return redirect()->to('home/login');
            }
        }


        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user visited log activity");
        }
        echo view('header');
        echo view('menu');
        echo view('log_activity', $data);
        echo view('footer');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function dashboard()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
     $nama_user = session()->get('nama_user');
       if ($nama_user) {
        $this->MKasir->insertLog("$nama_user Visited dashboard"); // ✅ Logs real nama_user
    }

     echo view('header');
     echo view('menu');
     echo view('dashboard');
     echo view('footer');
 }else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function tabel_kasir()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;

    $where= ('id_kasir');
                    // Get active kasir
    $parent['child'] = $MKasir->join_kasir_user();

    echo view('header');
    echo view ('menu.php');
    echo view ('tabel_kasir',$parent);
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function tabel_kasir_deleted() {
   if (session()->get('level')==3) {
    $MKasir = new M_kasir;
        // Get deleted kasir
    
    $parent['deleted_items'] = $MKasir->get_deleted_kasir();

    echo view('header');
    echo view('menu.php');
    echo view('tabel_kasir_deleted', $parent);
    echo view('footer.php');
} else if (session()->get('level') > 0) {
    return redirect()->to('home/error');
} else {
    return redirect()->to('home/login');
}
}
public function tambah_kasir()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    echo view('header');
    echo view ('menu.php');
    echo view ('tambah_kasir');
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}

public function simpan_tambah_kasir()
{
    $a=$this->request->getPost('username');
    $b=$this->request->getPost('password');
    $c=$this->request->getPost('nama');
    $d=$this->request->getPost('nik');


    $MKasir= new M_kasir;

    $data = array(
        "username"=>$a,
        "password"=>md5($b),
        "nama_user"=>$c,
        "level"=> 2,
        "created_at" => date('Y-m-d H:i:s', time()),
        "created_by" => session()->get('nama_user')
    );
    $MKasir->input('user', $data);

    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data['username']}' to user"); // ✅ Logs real nama_user
        }

    $where = array(
        "username"=>$a
    );
    $parent=$MKasir->getWhere('user', $where);
        // echo $wendy->id_user;
    $data2=array(
        "id_user"=>$parent->id_user,
        "nama_kasir"=>$c,
        "nik"=>$d,
        "created_at" => date('Y-m-d H:i:s', time()),
        "created_by" => session()->get('nama_user')
    );
        // print_r($data2);
    $MKasir->input('kasir', $data2);
    $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data2['nama_kasir']}' to kasir"); // ✅ Logs real nama_user
        }


    $where = array(
        "nik"=>$d
    );
    $parent=$MKasir->getWhere('kasir', $where);
    return redirect ()->to('home/tabel_kasir');
}
    // public function hapus_kasir ($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_user' =>$id);
    //     $MKasir->hapus('kasir',$fetch_id);
    //     $MKasir->hapus('user',$fetch_id);
    //     return redirect()->to('home/tabel_kasir');
    // }


public function hapus_kasir($id) {
    $MKasir = new M_kasir;
    $MKasir->soft_delete_kasir($id);
    $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted kasir with ID '$id'"); // ✅ Logs real nama_user
        }
    return redirect()->to('home/tabel_kasir');
}

public function restore_kasir($id) {
    $MKasir = new M_kasir;
    $MKasir->restore_kasir($id);
    $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored kasir with ID '$id'"); // ✅ Logs real nama_user
        }
    return redirect()->to('home/tabel_kasir_deleted');
}
public function delete_permanently_kasir($id) {
    $MKasir = new M_kasir;
    $MKasir->hard_delete_kasir($id);
    $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently deleted kasir with ID '$id'"); // ✅ Logs real nama_user
        }
    return redirect()->to('home/tabel_kasir_deleted');
}
public function restore_all_kasir() {
    $MKasir = new M_kasir;
    $MKasir->restore_all_kasir(); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all kasir"); // ✅ Logs real nama_user
        }
    return redirect()->to('home/tabel_kasir_deleted')->with('message', 'All kasir have been restored!');
}
public function detail_kasir ($id)
{
 if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
    $MKasir= new M_kasir;
    $fetch_id= array('kasir.id_user' =>$id);
    $parent['child']=$MKasir->joinw('kasir', 'user', 'kasir.id_user=user.id_user', $fetch_id);
    echo view('header');
    echo view ('menu.php');
    echo view ('detail_kasir',$parent);
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function edit_kasir ($id)
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;
    $fetch_id= array('kasir.id_user' =>$id);
    $parent['child']=$MKasir->joinw('kasir', 'user', 'kasir.id_user=user.id_user', $fetch_id);
    echo view('header');
    echo view ('menu.php');
    echo view ('edit_kasir',$parent);
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}

public function simpan_edit_kasir()
{
    $a=$this->request->getPost('username');
    $b=$this->request->getPost('password');
    $c=$this->request->getPost('nama');
    $d=$this->request->getPost('nik');

    $id = $this->request->getPost('id');
    $MKasir = new M_kasir;
    $where = array("id_user" => $id);

    // Update 'user' table data
    $data = array(
        "username"=>$a,
        "password"=>md5($b),
        "nama_user"=>$c,
        "level" => 2,
        "updated_at" => date('Y-m-d H:i:s', time()),
        "updated_by" => session()->get('nama_user')
    );
    $MKasir->edit('user', $data, $where);
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data['username']}' to user"); // ✅ Logs real nama_user
        }
    // Update 'dokter' table data
    $data2 = array(
        "nama_kasir"=>$c,
        "nik"=>$d,
        "updated_at" => date('Y-m-d H:i:s', time()),
        "updated_by" => session()->get('nama_user')
            // "status"=>"2"
    );
    $MKasir->edit('kasir', $data2, $where);
    $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data2['nama_kasir']}' to kasir"); // ✅ Logs real nama_user
        }

    return redirect()->to('home/tabel_kasir');
}
public function tabel_user()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;

        // FIXED: Use the correct function names
    $parent['child'] = $MKasir->tampil_active_no_sort('user', 'id_user', []);

    echo view('header');
    echo view ('menu.php');
    echo view ('tabel_user',$parent);
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function tabel_user_deleted()
{
    if (session()->get('level')==3) {
        $MKasir= new M_kasir;

        $parent['deleted_items'] = $MKasir->get_deleted_items_no_sort('user', 'id_user');

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_user_deleted',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function tambah_user()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    echo view('header');
    echo view ('menu.php');
    echo view ('tambah_user.php');
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function simpan_tambah_user()
{
    $MKasir= new M_kasir;
    $data = array(
        'username'=> $this->request->getPost('username'),
        'password'=> md5 ($this->request->getPost('password')),
        'nama_user'=> $this->request->getPost('nama'),
        'level'=> $this->request->getPost('level'),
             'created_at'  => date('Y-m-d H:i:s', time()), // ✅ Use Jakarta timezone
             'created_by'  => session()->get('nama_user')
         );

    $MKasir= new M_kasir;
    $MKasir->input('user',$data);
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data['username']}' to user"); // ✅ Logs real nama_user
        }
    return redirect ()->to('home/tabel_user');
}
    // public function hapus_user($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_user' =>$id);
    //     $parent['child']=$MKasir->hapus('user',$fetch_id);
    //     return redirect()->to('home/tabel_user');
    // }
public function hapus_user($id) {
    $MKasir = new M_kasir;
        $MKasir->soft_delete('user', 'id_user', $id); // Soft delete by setting status = 0
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted user with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user');
    }

    public function restore_user($id) {
        $MKasir = new M_kasir;
        $MKasir->restore('user', 'id_user', $id); // Restore by setting status = NULL
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored user with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user_deleted');
    }

    public function delete_permanently_user($id) {
        $MKasir = new M_kasir;
        $MKasir->hard_delete('user', 'id_user', $id); // Mark as permanently deleted (status = 1)
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently delete user with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user_deleted');
    }
    public function restore_all_user() {
        $MKasir = new M_kasir;
    $MKasir->restore_all('user'); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all user"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user_deleted')->with('message', 'All user have been restored!');
    }
    public function detail_user($id)
    {
     if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $fetch_id= array('id_user' =>$id);
        $parent['child']=$MKasir->getWhere('user',$fetch_id);
        echo view('header');
        echo view ('menu.php');
        echo view ('detail_user',$parent);
        echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function edit_user($id)
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;
    $fetch_id= array('id_user' =>$id);
    $parent['child']=$MKasir->getWhere('user',$fetch_id);
    echo view('header');
    echo view ('menu.php');
    echo view ('edit_user',$parent);
    echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function simpan_edit_user()
{
    $a=$this->request->getPost('username');
    $b=md5($this->request->getPost('password'));
    $c=$this->request->getPost('nama');
    $d=$this->request->getPost('level');
        $e=date('Y-m-d H:i:s', time()); // ✅ Use Jakarta timezone
        $f=session()->get('nama_user');
        $id=$this->request->getPost('id');
        $MKasir= new M_kasir;
        $fetch_id= array('id_user' =>$id);
        $data = array(
            "username"=>$a,
            "password"=>$b,
            "nama_user"=>$c,
            "level"=>$d,
            "updated_at"=>$e,
            "updated_by"=>$f
        );

        $MKasir= new M_kasir;
        $MKasir->edit('user',$data, $fetch_id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data['username']}' to user"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_user');
    }
    public function tabel_barang()
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
            $MKasir= new M_kasir;
            // Get sorting parameter from URL (e.g., home/tabel_barang?sort=nama_barang&order=ASC)
            $sort = $this->request->getGet('sort') ?? 'id_barang'; // Default sorting by ID
            $order = $this->request->getGet('order') ?? 'DESC'; // Default order DESC

            $parent['child'] = $MKasir->tampil_active('barang', 'id_barang', [], $sort, $order);

            echo view('header');
            echo view ('menu.php');
            echo view ('tabel_barang',$parent);
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function tabel_barang_deleted()
    {
        if (session()->get('level')==3) {
            $MKasir= new M_kasir;

            // Get sorting parameter from URL (e.g., home/tabel_barang?sort=nama_barang&order=ASC)
            $sort = $this->request->getGet('sort') ?? 'id_barang'; // Default sorting by ID
            $order = $this->request->getGet('order') ?? 'DESC'; // Default order DESC

            $parent['deleted_items'] = $MKasir->get_deleted_items('barang', 'id_barang', $sort, $order);

            echo view('header');
            echo view ('menu.php');
            echo view ('tabel_barang_deleted',$parent);
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function tambah_barang()
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
            echo view('header');
            echo view ('menu.php');
            echo view ('tambah_barang.php');
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function simpan_tambah_barang()
    {
        $MKasir= new M_kasir;
        $data = array(
            'kode_barang'=> $this->request->getPost('kode_barang'),
            'nama_barang'=> $this->request->getPost('nama_barang'),
            'jenis_barang'=> $this->request->getPost('jenis_barang'),
             'harga_satuan'=> str_replace('.', '', $this->request->getPost('harga_satuan')), // Remove thousands separator
             'stok'=> $this->request->getPost('stok'),
             'created_at'  => date('Y-m-d H:i:s', time()),
             'created_by'  => session()->get('nama_user')
         );

        $MKasir= new M_kasir;
        $MKasir->input('barang',$data);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data['nama_barang']}' to barang"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_barang');
    }
    // public function hapus_barang($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_barang' =>$id);
    //     $parent['child']=$MKasir->hapus('barang',$fetch_id);
    //     return redirect()->to('home/tabel_barang');
    // }
    //SOFT DELETE//
    public function hapus_barang($id) {
        $MKasir = new M_kasir;
        $MKasir->soft_delete('barang', 'id_barang', $id); // Soft delete by setting status = 0
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted barang with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang');
    }

    public function restore_barang($id) {
        $MKasir = new M_kasir;
        $MKasir->restore('barang', 'id_barang', $id); // Restore by setting status = NULL
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored barang with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang_deleted');
    }

    public function delete_permanently($id) {
        $MKasir = new M_kasir;
        $MKasir->hard_delete('barang', 'id_barang', $id); // Mark as permanently deleted (status = 1)
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently delete barang with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang_deleted');
    }
    public function restore_all_barang() {
        $MKasir = new M_kasir;
    $MKasir->restore_all('barang'); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all barang"); // ✅ Logs real nama_user
        }
    return redirect()->to('home/tabel_barang_deleted')->with('message', 'All barang have been restored!');
}
public function detail_barang($id)
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $fetch_id= array('id_barang' =>$id);
        $parent['child']=$MKasir->getWhere('barang',$fetch_id);
        echo view('header');
        echo view ('menu.php');
        echo view ('detail_barang',$parent);
        echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}

public function edit_barang($id)
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $fetch_id= array('id_barang' =>$id);
        $parent['child']=$MKasir->getWhere('barang',$fetch_id);
        echo view('header');
        echo view ('menu.php');
        echo view ('edit_barang',$parent);
        echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function simpan_edit_barang()
{
    $a=$this->request->getPost('kode_barang');
    $b=$this->request->getPost('nama_barang');
    $c=$this->request->getPost('jenis_barang');
    $d=$this->request->getPost('harga_satuan');
    $e=$this->request->getPost('stok');
    $f=date('Y-m-d H:i:s', time());
    $g=session()->get('nama_user');
    $id=$this->request->getPost('id');

    $MKasir= new M_kasir;
    $fetch_id= array('id_barang' =>$id);
    $data = array(
        "kode_barang"=>$a,
        "nama_barang"=>$b,
        "jenis_barang"=>$c,
        "harga_satuan"=>$d,
        "stok"=>$e,
        "updated_at"=>$f,
        "updated_by"=>$g
    );

    $MKasir= new M_kasir;
    $MKasir->edit('barang',$data, $fetch_id);
    $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data['nama_barang']}' to barang"); // ✅ Logs real nama_user
        }
    return redirect ()->to('home/tabel_barang');
}
public function tabel_nota()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $where= ('id_nota');
        $parent['child']=$MKasir->tampil ('nota',$where);

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_nota',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
    // public function hapus_nota($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_nota' =>$id);
    //     $parent['child']=$MKasir->hapus('nota',$fetch_id);
    //     return redirect()->to('home/tabel_nota');
    // }
public function tabel_transaksi()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $where= ('id_transaksi');
        $parent['child']=$MKasir->tampil ('transaksi',$where);

        $nama_user = session()->get('nama_user');
            if ($nama_user) {
            $this->MKasir->insertLog("$nama_user Visited tabel transaksi"); // ✅ Logs real nama_user
        }
        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_transaksi',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function transaksi()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;

        // Get the logged-in kasir using session
        $id_kasir = session()->get('id_kasir');
        $kasir = $MKasir->getWhere('kasir', ['id_kasir' => $id_kasir]); // ✅ Fix: Pass the table and condition correctly

        $parent['kasir'] = $kasir;

        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user Visited transaksi"); // ✅ Logs real nama_user
        }

        echo view('header');
        echo view ('menu.php');
        echo view ('transaksi',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function search()
{
    $MKasir = new M_kasir();
    $query = $this->request->getGet('query');

        // Fetch barang data based on kode_barang or nama_barang
    $barang = $MKasir->groupStart()
    ->like('kode_barang', $query)
    ->orLike('nama_barang', $query)
    ->groupEnd()
    ->where('status', null)
    ->findAll();

    return $this->response->setJSON($barang);
}
public function processTransaction()
{
    if ($this->request->getMethod() === 'post') {
        $db = \Config\Database::connect();
        $data = json_decode($this->request->getPost('data'), true);

        if (!$data || empty($data['items'])) {
            return $this->response->setJSON(['success' => false, 'error' => 'Data transaksi tidak valid.']);
        }

        try {
            $db->transStart();

            date_default_timezone_set('Asia/Jakarta');
            $today = date('Y-m-d');

            // Fetch latest nomor_nota for today
            $query = $db->table('nota')
            ->select('nomor_nota')
            ->where('DATE(tanggal)', $today)
            ->orderBy('CAST(nomor_nota AS UNSIGNED)', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

            $newNumber = ($query && is_numeric($query->nomor_nota)) ? ((int)$query->nomor_nota + 1) : 1;
            $nomor_nota = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $id_kasir = session()->get('id_kasir');

            $notaData = [
                'nomor_nota' => $nomor_nota,
                'grand_total' => $data['grand_total'],
                'bayar' => $data['bayar'],
                'kembali' => $data['kembali'],
                'keterangan' => 'Transaksi Berhasil',
                'id_kasir' => $id_kasir,
                'tanggal' => date('Y-m-d H:i:s')
            ];
            $db->table('nota')->insert($notaData);

            // Insert into transaksi table
            foreach ($data['items'] as $item) {
                $transaksiData = [
                    'tanggal' => date('Y-m-d H:i:s'),
                    'nomor_nota' => $nomor_nota,
                    'id_kasir' => $id_kasir,
                    'kode_barang' => $item['kode_barang'],
                    'jumlah' => $item['jumlah'],
                    'sub_total' => $item['sub_total']
                ];
                $db->table('transaksi')->insert($transaksiData);
            }

            $db->transComplete();

            $nama_user = session()->get('nama_user');
            if ($nama_user) {
            $this->MKasir->insertLog("$nama_user made transaction '{$notaData['nomor_nota']}' to nota and transaksi"); // ✅ Logs real nama_user
        }

            if ($db->transStatus() === false) {
                return $this->response->setJSON(['success' => false, 'error' => 'Gagal menyimpan transaksi.']);
            }

            return $this->response->setJSON(['success' => true, 'nomor_nota' => $nomor_nota]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}

public function print_nota($nomorNota)
{
    $MKasir = new M_kasir;
    $where = 'id_transaksi';
    date_default_timezone_set('Asia/Jakarta');
    // Fetch only today's transaction matching the nomor_nota
    $parent['child'] = $MKasir->join1('transaksi', 'nota', 'kasir', 'barang', 
      'transaksi.nomor_nota=nota.nomor_nota', 
      'transaksi.id_kasir=kasir.id_kasir', 
      'transaksi.kode_barang=barang.kode_barang', 
      $where, 
      $nomorNota);
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user printed nota '{$nomorNota}'"); // ✅ Logs real nama_user
        }

    echo view('print_nota', $parent);
}
public function print_ulang_nota($id)
{
    $MKasir = new M_kasir;
    $where = ['nota.id_nota' => $id]; // Select using the correct id_nota only
    $parent['child'] = $MKasir->join2(
        'transaksi', 
        'nota', 
        'kasir', 
        'barang', 
        'transaksi.nomor_nota=nota.nomor_nota', 
        'transaksi.id_kasir=kasir.id_kasir', 
        'transaksi.kode_barang=barang.kode_barang', 
        $where
    );


    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user printed back nota '{$id}'"); // ✅ Logs real nama_user
        }

    echo view('print_nota', $parent);
}



//     public function print_ulang_nota($id)
// {
//     $MKasir = new M_kasir;
//     $where=['nota.id_nota' => $id];
//      $parent['child'] = $MKasir->join2('transaksi', 'nota', 'kasir', 'barang', 
//           'transaksi.nomor_nota=nota.nomor_nota', 
//           'transaksi.id_kasir=kasir.id_kasir', 
//           'transaksi.kode_barang=barang.kode_barang', 
//           $where
//           );

//     echo view('print_nota', $parent);
// }
public function laporan_transaksi()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {

     $nama_user = session()->get('nama_user');
           if ($nama_user) {
            $this->MKasir->insertLog("$nama_user Visited laporan transaksi"); // ✅ Logs real nama_user
        }
     echo view('header');
     echo view ('menu.php');
     echo view ('laporan_transaksi');
     echo view ('footer.php');
 }else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function excel_transaksi()
{
   $MKasir = new M_kasir;
   $a = date('Y-m-d', strtotime($this->request->getPost('tanggal_awal')));
   $b = date('Y-m-d', strtotime($this->request->getPost('tanggal_akhir')));
   $where = 'id_transaksi';

   $parent['child'] = $MKasir->transaksi_filter($a, $b, $where);

   $nama_user = session()->get('nama_user');
 if ($nama_user) {
            $this->MKasir->insertLog("$nama_user made transaction report from  '{$a}' untill '{$b}'"); // ✅ Logs real nama_user
        }
   echo view('excel_transaksi', $parent);
}
public function pengaturan()
{
    if (session()->get('level')==3) {

    $db = db_connect();
    $pengaturan = $db->table('pengaturan_app')->get()->getRow();
    echo view('header');
    echo view ('menu.php');
    return view('pengaturan', ['pengaturan' => $pengaturan]);
    echo view ('footer.php');
 }else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}

public function simpan_pengaturan()
{
    $db = db_connect();
    $builder = $db->table('pengaturan_app');

    $data = [
        'judul' => $this->request->getPost('judul'),
        'nama_app' => $this->request->getPost('nama_app'),
    ];

    // Proses Upload Logo
    $logo = $this->request->getFile('logo');
    if ($logo && $logo->isValid() && !$logo->hasMoved()) {
        $newName = $logo->getRandomName();
        $logo->move('uploads/', $newName); // Simpan ke public/uploads/

        // Ambil data pengaturan yang sudah ada
        $pengaturan = $builder->get()->getRow();
        if (!empty($pengaturan->logo) && file_exists('uploads/' . $pengaturan->logo)) {
            unlink('uploads/' . $pengaturan->logo); // Hapus logo lama
        }

        $data['logo'] = $newName;
    }

    // Update atau insert data
    if ($builder->countAll() > 0) {
        $builder->update($data);
    } else {
        $builder->insert($data);
    }

    return redirect()->to('home/pengaturan')->with('success', 'Pengaturan berhasil disimpan.');
}
  // public function settings()
  //   {
  //       $data['settings'] = $this->MKasir->getSettings();
  //       return view('settings', $data);
  //   }

  //   public function update()
  //   {
  //       $fileLogo = $this->request->getFile('logo');
  //       $fileFavicon = $this->request->getFile('favicon');

  //       $data = [
  //           'app_name' => $this->request->getPost('app_name'),
  //           'title' => $this->request->getPost('title')
  //       ];

  //       // Handle logo upload
  //       if ($fileLogo->isValid() && !$fileLogo->hasMoved()) {
  //           $logoName = $fileLogo->getRandomName();
  //           $fileLogo->move('uploads/', $logoName);
  //           $data['logo'] = 'uploads/' . $logoName;
  //       }

  //       // Handle favicon upload
  //       if ($fileFavicon->isValid() && !$fileFavicon->hasMoved()) {
  //           $faviconName = $fileFavicon->getRandomName();
  //           $fileFavicon->move('uploads/', $faviconName);
  //           $data['favicon'] = 'uploads/' . $faviconName;
  //       }

  //       $this->MKasir->updateSettings($data);

  //       return redirect()->to(base_url('settings'))->with('success', 'Settings updated successfully');
  //   }
}
