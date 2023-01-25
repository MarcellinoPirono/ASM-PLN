@extends('layouts.main')

@section('content')
<div class="row">
@include('sweetalert::alert')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header position-relative justify-content-end float-right">
                                {{-- <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih SKK</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">Janurari</a>
                                        <a class="dropdown-item" href="javascript:void()">Februari</a>
                                    </div>
                                </div> --}}

                                <div class="col-xl-2 col-l-4 col-m-3 col-sm-2 mt-3">
                                    <select id="filter-addendum-khs" class="form-control filter">
                                        <option value="">Pilih SKK</option>
                                        @foreach ($skks as $khs)
                                            <option value="{{ $khs->id }}">{{ $khs->nomor_skk  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 col-l-4 col-m-3 col-sm-2 mt-3">
                                    <select id="filter-addendum-khs" class="form-control filter">
                                        <option value="">Pilih PRK</option>
                                        @foreach ($prks as $khs)
                                            <option value="{{ $khs->id }}">{{ $khs->no_prk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-xl-4 col-l-4 col-m-3 col-sm-2 mt-3">
                                    <select id="filter-addendum-kontrak-induk" class="form-control filter">
                                        <option value="">Pilih Nomor Kontrak Induk</option>
                                        @foreach ($kontrakinduks as $kontrakinduk)
                                            <option value="{{ $kontrakinduk->nomor_kontrak_induk }}">
                                                {{ $kontrakinduk->nomor_kontrak_induk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <a href="/po-khs/buat-po" type="button" class="btn btn-primary ml-3 mt-3">Buat Kontrak (PO) <i class="bi bi-pencil-square"></i>
                                </a>

                            </div>
                            <div id="" class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-responsive-md" id="ListTabelRab">
                                        <thead>
                                            <tr align="center" valign="middle">
                                                <th class="width80">No.</th>
                                                <th>Status</th>
                                                {{-- <th>Date</th> --}}
                                                {{-- <th>Nomor Surat</th> --}}
                                                <th>No. PO</th>
                                                <th>Tanggal PO</th>
                                                <th>No SKK</th>
                                                <th>No PRK</th>
                                                <th>Judul / Pekerjaan</th>
                                                <th>Lokasi</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                {{-- <th>Vendor</th> --}}
                                                <th>Nomor Kontrak Induk</th>
                                                <th>Total Harga</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody class="alldata">
                                            @foreach ($rabs as $rab)
                                                <tr>
                                                    <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                                    <td><span class="badge light badge-warning">Progress</span></td>
                                                    <td>{{ $rab->nomor_po }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($rab->tanggal_po)->isoFormat('dddd, DD-MMMM-YYYY')}}</td>
                                                    <td>{{ $rab->skks->nomor_skk }}</td>
                                                    <td>{{ $rab->prks->no_prk}}</td>
                                                    <td>{{ $rab->pekerjaan }}</td>
                                                    <td>{{ $rab->lokasi }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($rab->startdate)->isoFormat('dddd, DD-MMMM-YYYY')}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($rab->enddate)->isoFormat('dddd, DD-MMMM-YYYY')}}</td>
                                                    {{-- <td>{{ $rab->vendors->nama_vendor }}</td> --}}
                                                    <td>{{ $rab->nomor_kontraks->nomor_kontrak_induk }}</td>
                                                    <td>@currency($rab->total_harga) </td>

                                                <td>
													<div class="dropdown">
														<button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="preview-pdf-khs/{{$rab->slug}}">Preview <i class="bi bi-eye"></i></a>
															<a class="dropdown-item" href="download/{{ $rab->slug }}">Export (pdf) <i class="bi bi-file-earmark-pdf"></i></a>
															<a class="dropdown-item" href="export-excel-khs/{{ $rab->slug }}">Export (excel) <i class="bi bi-file-earmark-excel"></i></a>
														</div>
													</div>
												</td>

                                                </tr>
                                                @endforeach
                                        </tbody>
                                        <tbody id="Content" class="searchdata">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script data-require="jquery@2.1.1" data-semver="2.1.1"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script>
        var ListTabelRab = $('#ListTabelRab').DataTable({
            select:  {
                    style: 'multi'
            },
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }

        });
        $('#filter-kategori').on("change", function(event) {
            var categor = $('#filter-kategori').val();
            tableItem.columns(2).search(categor).draw();
        });

        // $('#filter-addendum-kontrak-induk').on("change", function(event) {
        //     var categor = $('#filter-addendum-kontrak-induk').val();
        //     tableItem.columns(2).search(categor).draw();
        // });
    </script>

@endsection

