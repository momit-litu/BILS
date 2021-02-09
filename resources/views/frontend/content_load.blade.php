@extends('frontend.layout.master')
@section('content')

    @php
        if(\Session::get('locale') == 'en') \App::setLocale('en');
        else 							    \App::setLocale('bn');
    @endphp


    <div  id="load-content" >
        <div class="panel panel-default border-none">
            <div class="panel-heading which_page">
            <!-- <i class="clip-home"></i>
                {{__('app.Dashboard')}}
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                        <i class="fa fa-refresh"></i>
                    </a>

                </div>
                -->
            </div>
            <div class="panel-body panel-scroll ps-container ps-active-y fixed-panel" >

            </div>
        </div>
    </div>



@section('JScript')
    <script>

        $('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+90));
        if(!localStorage.getItem('content')){
            window.location.href = "{{ url('app/dashboard')}}"
        }
    </script>

    <script src="{{-- asset('assets/js/bils/admin/user.js')--}}">
    </script>

@endsection




@endsection


@section('JScript')


    <script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
    <script>
    </script>

@endsection


