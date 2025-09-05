<div>
    <link href="../src/assets/css/light/apps/invoice-list.css" rel="stylesheet" type="text/css" />

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Payment</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    {{-- @include('livewire.settings.view-purchase-detail') --}}


    <div class="row layout-top-spacing">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-4 ">
            <label for="">From Date</label>
            <input type="date" class="form-control" wire:model.live="start_date">
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-4">
            <label for="">To Date</label>
            <input type="date" class="form-control" wire:model.live="end_date">

        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-5 ms-auto">
            <div class="d-flex gap-2 aligin-items-center">
                <button class="mt-4 btn btn-primary" id="payment-pdf-btn">PDF</button>
                <button class="mt-4 btn btn-primary" id="payment-excel-btn">Excel</button>
                <button class="mt-4 btn btn-primary" onclick="copyTable()">Copy</button>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-md-5">
        </div>
        <div class="col-12 col-md-4">
        </div>
        <div class="col-12 col-md-3">
            <input type="search" wire:model.live="search" class="form-control" placeholder="Search..."
                aria-controls="zero-config" style="">
        </div>
    </div>

    <div class="middle-content container-xxl p-0" wire:ignore.self>
        <div class="row" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12 mt-0 layout-top-spacing layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="table-responsive">
                        <table id="payment-repots" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th> S.no </th>
                                    <th>Purchase Id</th>
                                    <th>Purchase Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Payment Status</th>
                                    <th>Sub Total</th>
                                    <th>Grand Total</th>
                                    <th>Purchase Date</th>
                                    <th>Expire Date</th>
                                    <th>View More</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($paymentrepoprt->count() > 0)

                                    @foreach ($paymentrepoprt as $report)
                                        @php
                                            $user = App\Models\User::where('id', $report->user_id)->first();
                                        @endphp

                                        <tr class="text-center">
                                            <td> {{ $loop->index + 1 }}</td>
                                            <td>{{ $report->order_string }}</td>
                                            <td>{{ $report->purchase_type }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if ($report->payment_status == 1)
                                                <td><span class="badge badge-light-success inv-status">Payment
                                                        Success</span></td>
                                            @elseif($report->payment_status == 0)
                                                <td><span class="badge badge-light-danger inv-status">Payment
                                                        Failed</span>
                                                </td>
                                            @else
                                                <td><span class="badge badge-light-info inv-status">Payment
                                                        Pending</span>
                                                </td>
                                            @endif
                                            <td>
                                                <span class="inv-amount">₹ {{ $report->sub_total }}</span>
                                            </td>
                                            <td>
                                                <span class="inv-amount">₹ {{ $report->overall_total }}</span>
                                            </td>
                                            <td>
                                                <span class="inv-date">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                                            ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16"
                                                            y2="6">
                                                        </line>
                                                        <line x1="8" y1="2" x2="8"
                                                            y2="6">
                                                        </line>
                                                        <line x1="3" y1="10" x2="21"
                                                            y2="10">
                                                        </line>
                                                    </svg>
                                                    {{ date('dS F Y', strtotime($report->purchase_date)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="inv-date">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                                            ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16"
                                                            y2="6">
                                                        </line>
                                                        <line x1="8" y1="2" x2="8"
                                                            y2="6">
                                                        </line>
                                                        <line x1="3" y1="10" x2="21"
                                                            y2="10">
                                                        </line>
                                                    </svg>
                                                    {{ date('dS F Y', strtotime($report->expiry_date)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a class="me-3" data-bs-toggle="inputFormModal"
                                                    href="{{ route('purchase.detail', ['id' => $report->id]) }}"><img
                                                        src="{{ asset('src/assets/img/icons/eye.svg') }}"
                                                        alt="img">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center m-3" colspan="11" style="color: black">
                                            No matching records found
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @if ($paymentrepoprt)
        {{ $paymentrepoprt->links('vendor.livewire.bootstrap') }}
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof jsPDF !== 'undefined') {
            document.getElementById('payment-pdf-btn').addEventListener('click', function() {
                var doc = new jsPDF();
                var table = document.getElementById('payment-repots');
                doc.autoTable({
                    html: table
                });
                doc.save('paymentreports.pdf');
            });
        } else {
            alert('Error: jsPDF library is not loaded.');
        }
    });
</script>

<script>
    document.getElementById('payment-excel-btn').addEventListener('click', function() {
        var table = document.getElementById('payment-repots');
        var excelContent = '';
        for (var i = 0; i < table.rows.length; i++) {
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                excelContent += table.rows[i].cells[j].innerText + '\t';
            }
            excelContent += '\n';
        }

        var blob = new Blob([excelContent], {
            type: 'application/vnd.ms-excel'
        });
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.setAttribute('download', 'paymentreports.xls');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
</script>

<script>
    function copyTable() {
        var table = document.getElementById("payment-repots");
        var range = document.createRange();
        range.selectNode(table);
        var selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand("copy");
        selection.removeAllRanges();
        alert("Table copied to clipboard!");
    }
</script>
