@extends('layouts.layout')

@section('body_tag')
    <body class="hold-transition sidebar-mini" style="background-color: #f7f7f7">
@endsection

@section('content')
<section class="relative about-banner">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Law Firms
                </h1>
                <p class="text-white link-nav"><a href="{{ url('/') }}">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="{{ url('/firms') }}"> Law Firms </a></p>
            </div>
        </div>
    </div>
</section>
<br/>
<br/>
<br/>
<br/>
<div class="container" style="background:#f7f7f7">
    <div class="row">
        <div class="col-lg-8">
		@foreach ($firms as $firm)
		<div class="card mb-4">
			<div class="card-body">
				<div class="row">
				<div class="col-lg-8">
					<a href="#">
					<img style="float:left;height:150px;width:200px;" class="img-fluid rounded mr-3" src="img/blog/cat-widget2.jpg" alt="">
					</a>
				<h2 class="card-title" style="font-size:18pt">{{$firm->name}}</h2>
				<p >Major Practice Areas: {{$firm->practice_groups }} <br/> {{ $firm->city }}, {{$firm->country}} </p>

				<p>{{$firm->description}} </p>
				</div>
				<div class="col-lg-4">
					<div class="single-sidebar-widget post-category-widget">
                        <h5 class="category-title"><a href="{{ url($firm->website) }}" class="btn btn-primary" style="color:white;font-weight:bold">Visit Website</a>
                        </h5>
                        <ul class="cat-list">
                            <li>
                                <a href="#" class="justify-content-between">
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
                            <li>
                                <a href="{{ url('/firms/'.$firm->slug) }}" style="color:white;font-weight:bold" class="btn btn-primary justify-content-between">
                                    <i class="fa fa-user"></i> Law Firm Profile
                                </a>
                            </li>
                                </ul>
                    </div>
					</div>
				</div>
			</div>
			</div>
		@endforeach
		{{$firms->links()}}
    </div>
    <div class="col-lg-4 sidebar-widgets">
            <div class="widget-wrap">
                <div class="single-sidebar-widget search-widget">
                    <form class="search-form" action="#">
                        <input placeholder="Search Lawyers" name="search" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'" >
                    </form>
                </div>
                <div class="single-sidebar-widget user-info-widget">
                    <img src="img/blog/user-info.png" alt="">
                    <a href="#"><h4>Charlie Barber</h4></a>
                    <p>
                        Lawyer of the Day
                    </p>
                    <ul class="social-links">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                    <p>
                        Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits detractors.
                    </p>
                </div>
                <div class="single-sidebar-widget tag-cloud-widget">
                    <h4 class="tagcloud-title">Search By Legal Issue</h4>
                    <ul>
                        <li><a href="#">Divorce</a></li>
                        <li><a href="#">Finance</a></li>
                        <li><a href="#">Banking</a></li>
                        <li><a href="#">Real Estate</a></li>
                        <li><a href="#">Child Custody</a></li>
                        <li><a href="#">Insurance</a></li>
                        <li><a href="#">Car Accidents</a></li>
                        <li><a href="#">Immigration</a></li>
                        <li><a href="#">Criminal Defense</a></li>
                        <li><a href="#">Medical Malpractice</a></li>
                        <li><a href="#">Family Law</a></li>
                    </ul>
                </div>
            </div>
        </div>
</div>
</div>
@endsection
