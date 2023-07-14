<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 d-flex justify-content-center" id="row1">
            <div class="card px-4 py-4 h-100">
                <div class="card-body px-4">
                    <form action="" id="form-datos">
                    <h1 class="text-uppercase fw-bolder">busqueda</h1>
                        <div class="row">
                            <div class="col-md-12">
                              <label for="emisor_ruc" class="form-label fw-bolder"> Ruc emisor:</label>
                              <input type="text" class="form-control form-control-sm" name="emisor_ruc" id="emisor_ruc" placeholder="Ingrese el ruc">
                            </div>
                            <div class="col-md-12">
                              <label for="cliente_ruc" class="form-label fw-bolder"> Ruc cliente:</label>
                              <input type="text" class="form-control form-control-sm" name="cliente_ruc" id="cliente_ruc" placeholder="Ingrese el ruc">
                            </div>
                            <div class="col-md-12 m-4">
                              <label for="emisor_doc" class="form-label fw-bolder"> Tipo de documento:</label>
                              <div class="checkbox mx-4">
                                <div class="factura-electronica">
                                  <input class="form-check-input" type="radio" id="factura-electronica" name="emisor_doc" value="01">
                                  <label class="form-check-label  fw-bolder" for="factura-electronica">factura electrónica</label>
                                </div>
                            </div>                
                        </div>
                        <div class="btn_">
                            <input type="button" id="download" class="btn btn-outline-primary btn-xl" value="Buscar">       
                        </div>
                    </form>
                </div>
            </div>
    </div>
  </div>
  <main>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>  

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/scripts.js"></script>
</body>

</html>