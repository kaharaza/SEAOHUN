<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <!-- Navbar -->
    <?php // include_once './compomemt/navbar.php' 
    ?>

    <main class="bg-success">
        <div class="py-5 my-5">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-success fw-bold">Register SEAHUN</h1>
                    </div>
                    <div class="card-body">
                        <form id="formSubmit">
                            <div class="row g-2">
                                <div class="col-lg-6 col-12">
                                    <label for="fname">ชื่อ</label>
                                    <input type="text" class="form-control" id="fname" required>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <label for="lname">นามสกุล</label>
                                    <input type="text" class="form-control" id="lname" required>
                                </div>
                                <div class=" col-12">
                                    <label for="phone">เบอร์โทร</label>
                                    <input type="text" class="form-control" id="phone" required>
                                </div>
                                <div class=" col-12">
                                    <label for="email">อีเมล</label>
                                    <input type="text" class="form-control" id="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>




    <!-- Footer -->
    <?php // include_once './compomemt/footer.php' 
    ?>


    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="./js/register.js"></script>
</body>

</html>