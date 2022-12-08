
@extends('layouts.backoffice.admin.main-admin')
@section('title', 'Listes des Trajets')
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-10 col-md-6 col-sm-12">
                    <h2>Listes des Trajets</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Listes des Trajets</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                        <a href="{{ route('admin.path.create') }}"><button class="btn btn-primary" type="button">Ajouter un trajet</button></a>
                </div>

            </div>
            @if(Session::get("success"))
            <div class="alert alert-primary">
                {{ Session::get('success') }}
            </div>
            @endif
            @if(Session::get("fail"))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover product_item_list c_table theme-color mb-0">
                                <thead>
                                    <tr>
                                        <th>Agence</th>
                                        <th>Depart</th>
                                        <th>Arrivée</th>
                                        <th>Etat</th>
                                        <th data-breakpoints="sm xs md">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($datas as $Path)
                                        @forelse ($Path as $Path)
                                            <tr>
                                                <td>{{ $Path->agence }}</td>
                                                <td>{{ $Path->departure }}</td>
                                                <td><h5>{{ $Path->arrival }}</h5></td>

                                                <td>

                                                        @if($Path->state==1)
                                                            <h5 class="alert alert-primary">
                                                                Publié
                                                            </h5>
                                                        @endif

                                                        @if($Path->state==0)
                                                        <h5 class="alert alert-danger">
                                                            Non Publié
                                                        </h5>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.path.edit',$Path->id) }}" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-edit"></i></a>

                                                    <form method="POST" action="{{ route('admin.path.destroy', $Path->id) }}" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-default waves-effect waves-float btn-sm waves-red"  ><i class="zmdi zmdi-delete" aria-hidden="true" title="Suprimer"></i></button>

                                                       </form>
                                                </td>
                                            </tr>
                                        @empty

                                        @endforelse
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <ul class="pagination pagination-primary m-b-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
