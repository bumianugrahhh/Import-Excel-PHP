<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel to MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .upload {
            margin : auto;
            width : 600px;
            padding : 20px;
        }
        .btn {
            margin-top : 5px;
        }
    </style>
</head>
<body>
    <!-- Membuat Form Upload -->
    <div class="upload">

        <?php include("importexcel.php") ?>
         <!--enctype / ketika ingin mengupload file  -->
         <!-- class="row-g-2 / membentuk baris dengan 2 kolom -->
         <!-- class="col-auto" / membentuk kolom secara otomatis -->
        <form action="" method="POST" enctype="multipart/form-data" class="row-g-2">
            <div class="col-auto">
                <input class="form-control" type="file" name="filexls" id="formFile">
            </div>
            <div class="col-auto">
                <input type="submit" name="submit" class="btn btn-primary" value="Upload File Excel">
            </div>
        </form>

    </div>
    <!-- End Membuat Form Upload -->

    <!-- Ambil contoh file XLS, Siapkan Database & Tabel MySQL -->

    <!-- End Ambil contoh file XLS, Siapkan Database & Tabel MySQL -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>