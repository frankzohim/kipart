
@extends('layouts.backoffice.admin.main-admin')

@section('title', 'Ajouter un Bus')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Ajouter un Bus</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Ajouter un Bus</li>
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
                            @foreach ($datas as $bus)
                            <form method="POST" action="{{ route('admin.bus.update',$bus->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <label for="name">Selectionnez une Agence</label>
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="agency_id">
                                        @foreach ($dataAgency as $data)

                                            @foreach ($data as $agency)
                                                <option value="{{ $agency->id }}" @selected($bus->agency_id==$agency->id)>{{ $agency->name }}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                </div>
                                @error('agency_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                                 <label for="registration">Immatriculation</label>
                                <div class="form-group">
                                    <input type="text" id="email_address" class="form-control" name="registration" placeholder="Entrez le Num d'immatriculation" value="{{$bus->registration}}">
                                </div>
                                @error('registration')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label for="number_of_places">Nombre de place</label>
                            <div class="form-group">
                                <input type="text" id="email_address" class="form-control" name="number_of_places" placeholder="Entrez le nombre de place" value="{{$bus->number_of_places}}">
                            </div>
                            @error('number_of_places')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="card">
                            <div class="header">
                                <h2>Image <strong>plan</strong> de Bus</h2>
                            </div>
                            <div class="body">
                                <p>Selectionnez l'image</p>
                                <input type="file" class="dropify-fr" name="plan">
                            </div>
                            @error('plan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="col-lg-6">
                        <label for="email">Classe</label>
                        <div class="form-group">
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="class">


                                    <option value="vip"  @selected($bus->class=='vip')>Vip</option>
                                    <option value="Premium"  @selected($bus->class=='Premium')>Premium</option>
                                    <option value="Moyenne" @selected($bus->class=='Moyenne')>Moyenne</option>
                                    <option value="Luxueux"  @selected($bus->class=='Luxueux')>Luxueux</option>
                                    <option value="Normal"  @selected($bus->class=='Normal')>Normal</option>
                            </select>
                        </div>
                        @error('class')
                    <div class="text-danger">{{ $message }}</div>
                @enderror


                <label for="state">Etat</label>
                <select class="form-control show-tick ms select2" data-placeholder="Select" name="state">
                    <option value="1"   @selected($bus->state==1)>Publié</option>
                    <option value="0"   @selected($bus->state==0)>Non publié</option>
                </select>
                    @error('state')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                                <button type="submit" class="mt-3 btn btn-raised btn-primary btn-round waves-effect">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
