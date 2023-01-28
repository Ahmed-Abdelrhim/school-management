@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Blog Category Page </h4> <br><br>

                            <form method="post" id="myForm" action="{{ route('store.blog.category') }}">
                                @csrf


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="blog_category" class="form-control" type="text"
                                               id="example-text-input">

                                    </div>
                                </div>
                                <!-- end row -->


                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                       value="Insert Blog Category">
                            </form>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>


{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}
{{--            $('#myForm').validate({--}}
{{--                rules: {--}}
{{--                    blog_category: {--}}
{{--                        required: true,--}}
{{--                    },--}}
{{--                },--}}
{{--                messages: {--}}
{{--                    blog_category: {--}}
{{--                        required: 'Please Enter Blog Category',--}}
{{--                    },--}}
{{--                },--}}
{{--                // errorElement: 'span',--}}
{{--                errorPlacement: function (error, element) {--}}
{{--                    //label--}}
{{--                    // console.log(error[0]);--}}
{{--                    error.addClass('invalid-feedback');--}}
{{--                    element.closest('.form-group').append(error);--}}
{{--                },--}}
{{--                highlight: function (element, errorClass, validClass) {--}}
{{--                    console.log(validClass);--}}
{{--                    $(element).addClass('is-invalid');--}}
{{--                },0--}}
{{--                unhighlight: function (element, errorClass, validClass) {--}}
{{--                    $(element).removeClass('is-invalid');--}}
{{--                },--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules : {
                    blog_category : {
                        required: true,
                        min: 3,
                        max: 30,
                    },
                },
                messages: {
                    blog_category: {
                        required : 'Please Enter Blog Category',
                        min : 'Blog Category should not be less than 4 chars',
                        max : 'Blog Category should not be more than 30 chars',
                    },
                },

                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    console.log(element);
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

@endsection
