

@extends('layouts.backoffice.admin.main-admin')

@section('title', 'Ajouter un trajet')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Ajouter un Trajet</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Ajout trajet</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="header">

                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            @foreach ($datas as $paths)
                            <form method="POST" action="{{ route('admin.paths.update',$paths->id) }}">
                                @csrf
                                @method('PUT')

                            <label for="name">Selectionnez une Agence</label>
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="agency_id">
                                        @foreach ($dataAgency as $data)

                                            @foreach ($data as $agency)
                                            <option value="{{ $agency->id }}" @selected($paths->agency_id==$agency->id)>{{ $agency->name }}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                </div>
                                @error('agency_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                            <label for="departure">Depart</label>
                            <div class="form-group">
                                <input type="text" id="email_address" class="form-control" name="departure" placeholder="Entrez le lieu de depart"  value="{{ $paths->departure }}">
                            </div>
                            @error('departure')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <label for="arrival">Arrivé</label>
                        <div class="form-group">
                            <input type="text" id="email_address" class="form-control" name="arrival" placeholder="Entrez le lieu de depart" value="{{ $paths->arrival }}">
                        </div>
                        @error('arrival')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <label for="state">Etat</label>
                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="state">
                        <option value="1"   @selected($paths->state==1)>Publié</option>
                        <option value="0"   @selected($paths->state==0)>Non publié</option>
                    </select>
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                        <button type="submit" class="mt-3 btn btn-raised btn-primary btn-round waves-effect">Enregistrer</button>

                        @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</section>

@endsection
