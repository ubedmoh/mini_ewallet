@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notif')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Mutation</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <form class="form-inline" action="">
                            <div class="form-group">
                                <input type="date" name="tgl_mulai" id="tglmulai" class="form-control" value="" placeholder="Tgl Mulai">&nbsp; - &nbsp;
                                <input type="date" name="tgl_akhir" class="form-control" id="tglakhir" placeholder="Tgl Selesai"> &nbsp;
                                <button class="btn btn-outline-secondary" id="cari">Cari</button>
                            </div>
                        </form>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <table class="table table-responsive table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Date</th>
                                    <th width="20%">Activity</th>
                                    <th width="20%">Credit</th>
                                    <th width="20%">Debit</th>
                                    <th width="20%">Balance</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="list">
                                <tr>
                                    <td colspan="6" align="center">No Data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script
src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
		$('#cari').on('click', function(){
			var mulai = $('#tglmulai').val();
			var akhir = $('#tglakhir').val();
			$.ajax({
				url 	: "{{ route('mutasi.get') }}?tglmulai="+mulai+"&tglakhir="+akhir,
				method 	: 'GET',
				success : function(response){
					console.log(response)
					$('#list').html(response);
				}
			});
			return false;
		});
	});
</script>
@endsection
