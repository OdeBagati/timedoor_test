<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url('/') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Authors -->
            <li class="nav-item">
                <a class="nav-link" href="<?= url('/author') ?>">
                    <i class="fas fa-id-card"></i>
                    <span>Authors</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Books -->
            <li class="nav-item">
                <a class="nav-link" href="<?= url('/') ?>">
                    <i class="fas fa-book-open"></i>
                    <span>Books</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Input Rating -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ratings.create') }}">
                    <i class="fas fa-star"></i>
                    <span>Input Rating</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container mt-5">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Rating</h1>
                    <p class="mb-4">Input rating here</a>.</p>

                    @if ($message = Session::get('error'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('ratings.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Book">Select Book</label>
                            <select class="form-control" id="book_id" name="book_id" required>
                                <option>Select Book</option>
                                @foreach($dataBook as $book)
                                    <option value="{{ $book->book_id }}">{{ $book->book_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Author">Select Author</label>
                            <select class="form-control" id="author_id" name="author_id" required>
                                <option>Select Author</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Rating">Input Rating</label>
                            <select class="form-control" id="rating" name="rating">
                                @for ($i=1; $i<=10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/datatables-demo.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#book_id').change(function(){
                var id=$(this).val();

                $('#author_id').find('option').not(':first').remove();

                $.ajax({
                    url: '<?= url('/') ?>/getAuthor/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        // console.log(response);
                        var len = 0;
                        if(response != null){
                            len = response.length;
                        }

                        if(len > 0){
                            for(var i=0; i<len; i++){
                                console.log(response[i]);
                                var id = response[i].author_id;
                                var name = response[i].author_name;

                                var option = "<option value='"+id+"'>"+name+"</option>";

                                $("#author_id").append(option);
                            }
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>