@extends('Dashboard.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    Sections
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Sections</span>
            </div>
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Add Section</a>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Section name</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Created By</th>
                                <th class="border-bottom-0">Edit</th>
                                <th class="border-bottom-0">Delete</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($sections as $section)
                                <tr>
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$section->section_name}}
                                    </td>
                                    <td>
                                        {{$section->description}}
                                    </td>
                                    <td>
                                        {{$section->created_by}}
                                    </td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-outline-info" data-effect="effect-scale"
                                           data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                           data-description="{{ $section->description }}" data-toggle="modal" href="#exampleModal2">
                                            <i class="las la-pen"></i>
                                        </a>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-toggle="modal"
                                           href="#modaldemo9"><i class="las la-trash"></i></a>
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h3>Add Section</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{Route('section.store')}}" method="post">
                            @csrf
                            <label >Section Name</label><br>
                            <input type="text" name="section_name" placeholder="section name "><br>
                            <label >Section Description</label><br>
                            <input type="text" name="description" placeholder="section description (Optional) "><br>
                            <input type="hidden" name ="created_by" value="{{Auth()->user()->name}}">
                            <br>
                            <button class="btn ripple btn-primary" type="submit">Add Section</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h3>Edit Section</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('section/update')}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label">Section name</label>
                                <input class="form-control" name="section_name" id="section_name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <input class="btn ripple btn-sm btn-outline-success" type="submit">
                            <button class="btn ripple btn-sm btn-outline-danger" data-dismiss="modal" type="button">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

{{--        Delete--}}
        <div class="modal ltr_direction" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Delete Section</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="section/destroy" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p>Are You sure you want to delete this section ?</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{asset('assets/js/table-data.js')}}"></script>
    <script src="{{asset('assets/js/modal.js')}}"></script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>

@endsection
