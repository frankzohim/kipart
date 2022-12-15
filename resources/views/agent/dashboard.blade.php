@extends('layouts.backoffice.agent.main-agent')
@section('title', 'Dashboard-Admin')
@section('content')

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>{{ Auth::guard('agent')->user()->name }}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> Agence</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>Bus</h6>
                        <h2>20 <small class="info">Bus</small></h2>
                        <small>2% de plus que hier</small>
                        <div class="progress">
                            <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 2%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <div class="body">
                        <h6>Trajets</h6>
                        <h2>10 <small class="info">Trajets</small></h2>
                        <small>6% superieur a hier</small>
                        <div class="progress">
                            <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 6%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>Reservation</h6>
                        <h2>39 <small class="info">Reservation</small></h2>
                        <small>50% de plus que hier</small>
                        <div class="progress">
                            <div class="progress-bar l-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100" style="width: 39%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <div class="body">
                        <h6>Ticket Vendus </h6>
                        <h2>100 <small class="info">Nouveaux</small></h2>
                        <small>20% de plus que hier</small>
                        <div class="progress big_icon domains">
                            <div class="progress-bar l-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content -->

    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Ticket list</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h5>2,365</h5>
                                <span>Total Tickets</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#FFC107">5,2,3,7,6,4,8,1</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h5>365</h5>
                                <span>Validé</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#46b6fe">8,2,6,5,1,4,4,3</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h5>65</h5>
                                <span>En Attente</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#ee2558">4,4,3,9,2,1,5,7</div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h5>2,055</h5>
                                <span>Renvoyer</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#04BE5B">7,5,3,8,4,6,2,9</div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Bus</th>
                                        <th>Trajet</th>
                                        <th>Date</th>
                                        <th>heure</th>
                                        <th>Classe</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>A2586</strong></td>
                                        <td><a href="#" title="">Jean Rousseau</a></td>
                                        <td>LT 390</td>
                                        <td>Doual-Yaounde</td>
                                        <td>02 Janv 2023</td>
                                        <td>11h</td>
                                        <td>VIP</td>
                                        <td><span class="badge badge-warning">en attente</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>A4578</strong></td>
                                        <td><a href="ticket-detail.html" title="">Marie Nicaise</a></td>
                                        <td>CE 879</td>
                                        <td>Douala - Baff</td>
                                        <td>04 Jan 2023</td>
                                        <td>6h</td>
                                        <td>CLASSIQUE</td>
                                        <td><span class="badge badge-warning">En attente</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>A6523</strong></td>
                                        <td><a href="ticket-detail.html" title="">Paul Loussa</a></td>
                                        <td>CE 890</td>
                                        <td>Douala-Yaounde</td>
                                        <td>09 Jan 2023</td>
                                        <td>4h30</td>
                                        <td>PRESTIGE</td>
                                        <td><span class="badge badge-info">Validé</span></td>
                                    </tr>

                                    <tr>
                                        <td><strong>A6573</strong></td>
                                        <td><a href="#" title="">Paul poopo</a></td>
                                        <td>CE 890</td>
                                        <td>Douala-Yaounde</td>
                                        <td>09 Jan 2023</td>
                                        <td>4h30</td>
                                        <td>VVIP</td>
                                        <td><span class="badge badge-info">Validé</span></td>
                                    </tr>

                                    <tr>
                                        <td><strong>A3573</strong></td>
                                        <td><a href="#" title="">Noum poopo</a></td>
                                        <td>LT 890</td>
                                        <td>Douala-Dschang</td>
                                        <td>10 Jan 2023</td>
                                        <td>8h30</td>
                                        <td>Classique</td>
                                        <td><span class="badge badge-info">Validé</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>A3573</strong></td>
                                        <td><a href="#" title="">Noumbisie Marthe</a></td>
                                        <td>OU 890</td>
                                        <td>Douala-Bafang</td>
                                        <td>20 Dec 2022</td>
                                        <td>8h30</td>
                                        <td>Classique</td>
                                        <td><span class="badge badge-info">Validé</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pagination-primary mt-4">
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">5</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div class="row clearfix">


            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body">
                        <div class="chat-widget">
                            <ul class="list-unstyled">
                                <li class="left">
                                    <img src="admin/assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">
                                    <ul class="list-unstyled chat_info">
                                        <li><small>Buca 11:00AM</small></li>
                                        <li><span class="message bg-blue">Hello, Kipart</span></li>
                                        <li><span class="message bg-blue">Bonjour</span></li>
                                    </ul>
                                </li>
                                <li class="right">
                                    <ul class="list-unstyled chat_info">
                                        <li><small>11:10AM</small></li>
                                        <li><span class="message">Hello, Buca</span></li>
                                    </ul>
                                </li>
                                <li class="right">
                                    <ul class="list-unstyled chat_info">
                                        <li><small>11:11AM</small></li>
                                        <li><span class="message">Bonjour a vous</span></li>
                                    </ul>
                                </li>
                                <li class="left">
                                    <img src="admin/assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                                    <ul class="list-unstyled chat_info">
                                        <li><small>Buca 11:13AM</small></li>
                                        <li><span class="message bg-blue">Besoin d'aide pour ajouter un trajet</span></li>
                                    </ul>
                                </li>
                                <li class="left">
                                    <li class="right">
                                        <ul class="list-unstyled chat_info">
                                        <li><small>KiPART 11:14AM</small></li>
                                        <li><span class="message">D'accord</span></li>
                                        <li><span class="message ">Nous vous ecoutons.</span></li>
                                        <li><span class="message ">quel est le soucis?</span></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);">Tim Hank</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Hossein Shams</a>
                                    <a class="dropdown-item" href="javascript:void(0);">John Smith</a>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter text here..." aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-mail-send"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection
