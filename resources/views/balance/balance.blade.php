@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notif')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Balance</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('person.topup') }}">
                            @csrf
                            <table class="table">
                                <tr>
                                    <td><h3>Name</h3></td>
                                    <td><h3> : </h3></td>
                                    <td><h3>{{ $balance->user->name }}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Email</h3></td>
                                    <td><h3> : </h3></td>
                                    <td><h3>{{ $balance->user->email }}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Balance</h3></td>
                                    <td><h3> : </h3></td>
                                    <td><h3>Rp. {{ number_format($balance->balance, 0, ',', '.') }}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Topup</h3></td>
                                    <td><h3> : </h3></td>
                                    <td>
                                        <input type="hidden" name="user_id" value="{{  $user_id }}">
                                        <input type="number" class="form-control" name="isi" min="0" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin topup dengan total uang tersebut?')">Topup</button></td>
                                </tr>
                            </table>
                        </form>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><strong>Topup</strong></label>

                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="isi" min="0" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
