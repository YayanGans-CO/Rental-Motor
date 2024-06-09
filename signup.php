<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

</head>

<body class="bg-gradient-primary">
    <form action="process_signup.php" method="POST">
        <input type="text" class="form-control form-control-user" id="username"
            name="username" placeholder="Username" required>
        <input type="email" class="form-control form-control-user" id="email" name="email"
            placeholder="Email Address" required>
        <input type="password" class="form-control form-control-user"
            id="password" name="password" placeholder="Password" required>
        <input type="text" class="form-control form-control-user" id="nama_lengkap"
            name="nama_lengkap" placeholder="Full Name" required>
        <input type="text" class="form-control form-control-user" id="alamat" name="alamat"
            placeholder="Address" required>
        <input type="text" class="form-control form-control-user" id="nomor_telepon"
            name="nomor_telepon" placeholder="Phone Number" required>
        <select id="role" name="role" class="form-control form-control-user">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            SignUp
        </button>
    </form>
</body>

</html>
