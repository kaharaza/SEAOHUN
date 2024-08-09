<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check in</title>
</head>

<body>
    <main>

    </main>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./../css/style.css">

</head>

<body>
    <main class="bg-success">
        <div class="py-5 my-5">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form id="CheckIn">
                            <h1>ระบบ Check-in หน้างาน</h1>
                            <div class="row g-2">
                                <div class="col-12">
                                    <label for="fname">First name</label>
                                    <input type="text" class="form-control" placeholder="First name" id="fname" required>
                                </div>
                                <div class="col-12">
                                    <label for="lname">Last name</label>
                                    <input type="text" class="form-control" placeholder="Last name" id="lname" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Check in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h1>รายชื่อผู้เข้าร่วม</h1>
                        <div id="tableCheckIn"></div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="./../js/checkin.js"></script>

</body>

</html>