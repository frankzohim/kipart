

@extends('layouts.backoffice.admin.main-admin')

@section('title', 'Ajouter un voyage')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Ajouter un voyage</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Ajout voyage</li>
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
                            @foreach ($datas as $travel)
                            <form method="POST" action="{{ route('admin.travels.update',$travel->id) }}">
                                @csrf
                                @method('PUT')



                                @csrf
                                <label for="name">Selectionnez une Agence</label>
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="agency_id">
                                        @foreach ($dataAgency as $data)

                                            @foreach ($data as $agency)
                                                <option value="{{ $agency->id }}" @selected($travel->agency_id==$agency->id)>{{ $agency->name }}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                </div>
                                @error('agency_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="email">Depart</label>
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="path_id">
                                        @foreach ($dataPath as $data)

                                            @foreach ($data as $path)
                                                <option value="{{ $path->id }}"  @selected($travel->path_id==$path->id)>{{ $path->departure }} - {{ $path->arrival }}</option>
                                            @endforeach
                                        @endforeach

                                    </select>

                                    @error('path_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label for="email">Classe</label>
                                    <div class="form-group">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="class">


                                                <option value="vip"  @selected($travel->class=='vip')>Vip</option>
                                                <option value="Premium"  @selected($travel->class=='Premium')>Premium</option>
                                                <option value="Moyenne" @selected($travel->class=='Moyenne')>Moyenne</option>
                                                <option value="Luxueux"  @selected($travel->class=='Luxueux')>Luxueux</option>
                                                <option value="Normal"  @selected($travel->class=='Normal')>Normal</option>
                                        </select>
                                    </div>
                                    @error('class')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                                <label for="prix">Prix</label>
                                <div class="form-group">
                                    <input type="number" id="number" class="form-control" name="price" value="{{ $travel->prix }}">
                                </div>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label for="date">date</label>
                            <div class="form-group">
                                <input type="date" id="number" class="form-control" name="date" value="{{ $travel->date }}">
                            </div>
                            @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            <label for="state">Etat</label>
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="state">
                                <option value="1"   @selected($travel->state==1)>Publié</option>
                                <option value="0"   @selected($travel->state==0)>Non publié</option>
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
