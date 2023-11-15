@extends('Dashboard.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoices List</span>
            </div>
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
               href="#modaldemo8">Add invoice</a>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        @if (session('msg'))
            <div class="alert alert-success w-100">
                {{ session('msg') }}
            </div>
        @endif
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Invoice Date</th>
                                <th class="border-bottom-0">Due time</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">Section</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Tax Percentage</th>
                                <th class="border-bottom-0">Tax Value</th>
                                <th class="border-bottom-0">Total</th>
                                <th class="border-bottom-0">Rest to pay</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Notes</th>
                                <th class="border-bottom-0">Edit</th>
                                <th class="border-bottom-0">Delete</th>
                                <th class="border-bottom-0">Pay</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$invoice->invoices_date}}
                                    </td>
                                    <td>
                                        {{$invoice->due_time}}
                                    </td>
                                    <td>
                                        {{$invoice->product}}
                                    </td>
                                    <td>
                                        {{$invoice->section}}
                                    </td>
                                    <td>
                                        {{$invoice->discount}}
                                    </td>
                                    <td>
                                        {{$invoice->tax_percent}}
                                    </td>
                                    <td>
                                        {{$invoice->tax_value}}
                                    </td>
                                    <td>
                                        {{$invoice->total}}
                                    </td>
                                    <td>
                                        {{$invoice->restToPay}}
                                    </td>
                                    <td>
                                        {{$invoice->status}}
                                    </td>
                                    <td>
                                        {{$invoice->note}}
                                    </td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-outline-info" data-effect="effect-scale"
                                           data-id="{{ $invoice->id }}"
                                           data-toggle="modal" href="#exampleModal2">
                                            <i class="las la-pen"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a class="modal-effect btn btn-sm btn-outline-danger" data-effect="effect-scale"
                                           data-id="{{ $invoice->id }}" data-product_name="{{ $invoice->product_name }}"
                                           data-toggle="modal"
                                           href="#modaldemo9"><i class="las la-trash"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-success"
                                           href="{{route('pay_now', $invoice->id)}}"><i
                                                class="fe fe-credit-card"></i>
                                        </a>
                                        {{--                                        <form action="{{route('pay_now',$invoice->id)}}" method="post">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            @method('POST')--}}
                                        {{--                                            <button type="submit">--}}
                                        {{--                                                Pay now--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </form>--}}
                                        {{--                                        <a href="{{route('pay_now',$invoice->id)}}">test new</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            @php
                            $i++;
                            @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        {{--                    NEW INVOICE                                                                         --}}
        <div class="modal ltr_direction" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h3>Select section to add new invoice</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{Route('invoices.create')}}" method="post">
                            @csrf
                            @method('get')
                            <div class="form-group">
                                <label>select section to create new invoice</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled>Pick a section</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn ripple btn-primary" type="submit">Select Section</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade ltr_direction" id="exampleModal2" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h3>Edit Invoice</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('invoices/'."id".'/edit')}}" method="post">
                            @csrf
                            @method('get')
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="section" value="">
                                <label>Press submit to edit</label>
                            </div>
                            <input class="btn ripple btn-sm btn-outline-success" type="submit">
                            <button class="btn ripple btn-sm btn-outline-danger" data-dismiss="modal" type="button">
                                Close
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--                            Delete                                              --}}
        <div class="modal ltr_direction" id="modaldemo9" dir="ltr" lang="en">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Delete Invoice</h6>
                        {{--                                    <button aria-label="Close" class="close float-right flex-col" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>--}}
                    </div>
                    <form action="{{url('invoices/destroy')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p>Are You sure you want to delete this Invoice ?</p><br>
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        $('#exampleModal2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
