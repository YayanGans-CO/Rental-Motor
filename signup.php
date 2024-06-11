<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-primary">
    <form action="process_signup.php" method="POST" class="max-w-md mx-auto">
        <input type="text" class="input-field" id="username" name="username" placeholder="Username" required>
        <input type="email" class="input-field" id="email" name="email" placeholder="Email Address" required>
        <input type="password" class="input-field" id="password" name="password" placeholder="Password" required>
        <input type="text" class="input-field" id="nama_lengkap" name="nama_lengkap" placeholder="Full Name" required>
        <input type="text" class="input-field" id="alamat" name="alamat" placeholder="Address" required>
        <input type="text" class="input-field" id="nomor_telepon" name="nomor_telepon" placeholder="Phone Number"
            required>
        <select id="role" name="role" class="input-field">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" class="btn-primary btn-block">
            SignUp
        </button>
    </form>



    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create an account
                    </h1>
                    <form action="process_signup.php" method="POST" class="space-y-4 md:space-y-6 max-w-md mx-auto">
                        <div>
                            <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Full
                                Name</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Full Name" required="">
                        </div>
                        <div>
                            <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900">Phone
                                Number</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Phone Number" required="">
                        </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Username" required="">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="your@gmail.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div>
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                            <select id="role" name="role" class="input-field">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <button type="submit" name="registration"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Create an account
                        </button>
                        <div class="flex justify-center items-center">
                            <a href="login.php" class="text-sm font-light text-blue-500 hover:underline">
                                Already have an account?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</body>

</html>