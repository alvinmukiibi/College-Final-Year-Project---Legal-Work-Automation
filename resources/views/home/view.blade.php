@extends('layouts.layout');

@section('body_tag')
    <body style="background:#f7f7f7">
@endsection

@section('content')

<section class="relative about-banner">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        {{$firm->name}}
                    </h1>
                    <p class="text-white link-nav"><a href="{{ url('/') }}">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="{{ url('/firms') }}"> Firm </a></p>
                </div>
            </div>
        </div>
    </section>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container" >
            <div class="row">
                <div class="col-lg-12">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6">
                            <a href="#">
                            <img style="float:left;height:150px;width:200px;" class="img-fluid rounded mr-3" src="{{asset('uploads/firms'.$firm->avatar)}}" alt="">
                            </a>

                        <h2 class="card-title" style="font-size:18pt">{{$firm->name}}</h2>
                        <p >Major Practice Areas: {{$firm->practice_groups }} <br/>
                        {{ $firm->street_address }},
                        {{ $firm->city }}, {{$firm->country}} </p>



                        </div>
                        <div class="col-lg-3">
                                <p>Past Client? Leave a review</p>
                                <a href="" class="btn btn-default"><i class="fa fa-pencil"></i>Write a Review</a>



                            </div>
                        <div class="col-lg-3">
                            <div class="single-sidebar-widget post-category-widget">
                                <h4 class="category-title"><a href="{{ $firm->website}}" class="btn btn-danger" style="color:white;font-weight:bold">VISIT WEBSITE</a>
                                </h4>
                                <ul class="cat-list">
                                    <li>
                                        <a href="#" class=" justify-content-between">
                                            <i class="fa fa-phone"></i> {{$firm->contact1}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class=" justify-content-between">
                                            <i class="fa fa-phone"></i> {{$firm->contact2}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class=" justify-content-between">
                                            <i class="fa fa-envelope"></i> {{$firm->email}}
                                        </a>
                                    </li>

                                        </ul>
                            </div>





                            </div>
                        </div>
                    </div>


                    </div>	</div>	</div>
                    <div class="row">
                            <div class="col-lg-8">
                                    <div class="card">
                                            <div class="card-header">

                                              <ul class="nav nav-pills ">
                                                <li class="nav-item">
                                                  <a class="nav-link " href="#firminfo" data-toggle="tab">Firm Info</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#reviews" data-toggle="tab">Reviews</a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="card-body">
                                              <div class="tab-content p-0">

                                                <div class="tab-pane active" id="firminfo">
                                                        <section class="post-content-area ">

                                                                    <div class="row">

                                                                            <div class="single-post row">

                                                                                <div class="col-lg-4  col-md-4 meta-details">

                                                                                    <div class="user-details row">
                                                                                    <p class="user-name col-lg-12 col-md-12 col-6"><a href="#">{{$firm->email}}</a> <i class="fa fa-envelope"></i></p>
                                                                                        <p class="date col-lg-12 col-md-12 col-6"><a href="#">{{$firm->contact1}}</a> <i class="fa fa-mobile"></i></p>
                                                                                        <p class="view col-lg-12 col-md-12 col-6"><a href="#">{{$firm->contact2}}</a> <i class="fa fa-phone"></i></p>
                                                                                        <p class="comments col-lg-12 col-md-12 col-6"><a href="#">06 Reviews</a> <i class="fa fa-comment"></i></p>

                                                                                        <ul class="social-links col-lg-12 col-md-12 col-6">
                                                                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-8 col-md-8">
                                                                                    <h3 class="mt-20 mb-20">Firm Description</h3>
                                                                                    <p class="excert">
                                                                                      {{ $firm->description}}
                                                                                    </p>
                                                                                    <h3 class="mt-20 mb-20">Address</h3>
                                                                                    <p class="excert">
                                                                                      {{ $firm->street_address}}
                                                                                    </p>
                                                                                    <h3 class="mt-20 mb-20">Practice Areas</h3>
                                                                                    <p class="excert">
                                                                                      {{ $firm->practice_groups}}
                                                                                    </p>




                                                                            </div> </div> </section>


                                                    </div>
                                                <div class="tab-pane" id="reviews" style="position: relative; height: 300px;">
                                                hjhg
                                                </div>
                                              </div>
                                            </div>
                                          </div>



                            </div>
                            <div class="col-lg-4">
                                    <div class="comment-form">
                                    <h4>Contact <span style="color:red">{{$firm->name}}</span></h4>
                                            <form>
                                                <div class="form-group form-inline">
                                                  <div class="form-group col-lg-6 col-md-12 name">
                                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                                  </div>
                                                  <div class="form-group col-lg-6 col-md-12 email">
                                                    <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                    <select name="practice_areas" class="form-control">
                                                            <option value="Litigation">Litigation</option>
                                                            <option value="Criminal Defense">Criminal Defense</option>
                                                            <option value="Banking">Banking</option>
                                                            <option value="Corporate">Corporate</option>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control mb-10" rows="5" name="message" placeholder="What's your legal issue? Give a description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Legal issue'" required=""></textarea>
                                                </div>
                                                <a href="#" class="primary-btn text-uppercase">Send Message</a>
                                            </form>
                                        </div>
                                        <div class="map-wrap" style="width:100%; height: 250px;" id="map"></div>

                                </div>
                            </div>

                        </div>


@endsection
