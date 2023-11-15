@extends('dashboard.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    Add invoice
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices list</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Add new invoice</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('pay' , $invoice->id)}}" method="post" autocomplete="off">
                        @csrf
                        @method('GET')
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="id" value="{{$invoice->id}}">
                                <label for="inputName" class="control-label">Invoice number</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                       value="{{$invoice->invoice_number}}" readonly>
                            </div>

                            <div class="col">
                                <label>Invoice Date</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                       type="text" value="{{$invoice->invoices_date}}" readonly>
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                       value="{{$invoice->due_time}}" type="text" readonly>
                            </div>
                        </div>

                        {{-- 2 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Section</label>
                                <input type="text" class="form-control" id="section_name" name="section_name" value="{{$invoice->section}}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Product</label>
                                <select name="product" id="product" class="form-control" readonly>
                                    <option value="{{$invoice->product}}" readonly >{{$invoice->product}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Bill Amount</label>
                                <input type="text" class="form-control" id="inputName" name="bill_amount"
                                       value="{{$invoice->bill_amount}}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Commission</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                       name="Amount_Commission" value="{{$invoice->commission}}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Discount</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       value="{{$invoice->discount}}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Tax percentage</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" readonly>
                                    <!--placeholder-->
                                    <option value="{{$invoice->tax_percent}}" readonly>{{$invoice->tax_percent}}</option>
                                </select>
                            </div>
                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Total Tax value</label>
                                <input type="text" value="{{$invoice->tax_value}}" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total</label>
                                <input type="text" value="{{$invoice->total}}" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Notes</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                            <input type="hidden" value="{{Auth()->user()->name}}" name="user">
                        </div><br>

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Commission</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                       name="Amount_Commission" value="{{$invoice->commission}}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Discount</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name=""
                                       value="{{$invoice->discount}}" readonly>
                            </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Total to pay</label>
                                <input type="text" value="" class="form-control" id="pay" name="pay">
                            </div>

                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>


    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('Please insert the Commission value');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }

    </script>


@endsection
