@extends('fonts.layouts.user')
@section('site')
    | My | Tree
@endsection
@section('style')
    <style>
        .userInfo {
            display: none;
        }
        .user {
            width: 70px;
            text-align: center;
        }
        .page-content {
            min-height: 980px !important;
        }

        /*responsive for user dashboard*/
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .input-lg {
                width: 100%!important;
            }
        }
        @media only screen and (max-width: 480px) {
            .user img {
                width: 50px !important;
            }
            .input-lg {
                width: 278px!important;
            }
            .portlet.box.dark {
                border: none;
            }
            .popover-content{
                width: 200px;
            }
            .page-content {
                min-height: 980px !important;
            }
        }
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-7 col-xs-offset-2 pranto">

                        <div class="user" style="text-align: center; margin: auto;">
                            @if(Auth::user()->paid_status == 0)
                                <img src="{{asset('assets/user/user.png')}}" alt="**" style="width:100%;">
                            @else
                                <img src="{{asset('assets/user/paid_user.png')}}" alt="**" style="width:100%;">
                            @endif
                            {{Auth::user()->username}}
                            <div class="userInfo">
                                <div class="panel panel-success" style="text-align: center;">
                                    <div class="panel-heading">
                                        <a href="{{url('tree/'.Auth::user()->username)}}">
                                            <h4> {{Auth::user()->username}}</h4>
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        @php
                                        echo "<h5>".strtoupper(Auth::user()->first_name.' '.Auth::user()->last_name)." </h5>";
                                        printBV(Auth::user()->id);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div style="margin-top:100px;"></div>

            <div class="row">

                @php $a = $first_tree->count(); @endphp
                @foreach($first_tree as $key => $data)
                    <div class="col-xs-4">
                        <div class="col-xs-6 col-xs-offset-2 pranto">

                            <div class="user" style="text-align: center; margin: auto;">
                                @if($data->paid_status == 0)
                                    <img src="{{asset('assets/user/user.png')}}" alt="**" style="width:100%;">
                                @else
                                    <img src="{{asset('assets/user/paid_user.png')}}" alt="**" style="width:100%;">
                                @endif
                                {{$data->username}}
                                <div class="userInfo">
                                    <div class="panel panel-success" style="text-align: center;">
                                        <div class="panel-heading">
                                            <a href="{{url('tree/'.$data->username)}}">
                                                <h4> {{$data->username}}</h4>
                                            </a>
                                        </div>
                                        <div class="panel-body">
                                            @php
                                                echo "<h5>".strtoupper($data->first_name.' '.$data->last_name)." </h5>";
                                                printBV($data->id);
                                        @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($a < 3 )
                    @for($i=1; $i<$a; $i++)

                        <div class="col-xs-4">
                            <div class="col-xs-6 col-xs-offset-2 pranto">
                                <div class="user" style="text-align: center; margin: auto;">
                                    <img src="{{asset('assets/user/no_user.png')}}" alt="**" style="width:100%;">
                                    NO USER
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
            <div style="margin-top:100px;"></div>
            <div class="row">

            @foreach($first_tree as $i => $a)

                    <div class="col-xs-4" style="{{ $i==2 ? '':'border-right:1px solid #000;'}}">
                        <div class="row">
                            @php $u =  \App\User::where('position', $a->id)->get(); @endphp

                            @php $t = $u->count(); @endphp

                                @foreach($u as $p)
                                <div class="col-xs-4">

                                <div class="user" style="text-align: center; margin: auto;">
                                    @if($p->paid_status == 0)
                                        <img src="{{asset('assets/user/user.png')}}" alt="**" style="width:100%;">
                                    @else
                                        <img src="{{asset('assets/user/paid_user.png')}}" alt="**" style="width:100%;">
                                    @endif
                                    {{$p->username}}
                                    <div class="userInfo">
                                        <div class="panel panel-success" style="text-align: center;">
                                            <div class="panel-heading">
                                                <a href="{{url('tree/'.$p->username)}}">
                                                    <h4> {{$p->username}}</h4>
                                                </a>
                                            </div>
                                            <div class="panel-body">
                                                @php
                                                    echo "<h5>".strtoupper($p->first_name.' '.$p->last_name)." </h5>";
                                                     printBV($p->id);
                                                @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        @if($t < 3 )
                            @for($q=$t; $q<3; $q++)
                                <div class="col-xs-4 pranto">
                                    <div class="user" style="text-align: center; margin: auto;">
                                        <img src="{{asset('assets/user/no_user.png')}}" alt="**" style="width:100%;">
                                        NO USER
                                    </div>
                                </div>
                            @endfor
                        @endif
                            </div><!--row-->
                    </div><!--4-->
                @endforeach
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script>
        $('.pranto').each(function() {
            var $this = $(this);
            $this.popover({
                trigger: 'click , hover',
                placement: 'bottom',
                html: true,
                content: $this.find('.userInfo').html()
            });
        });
    </script>
@endsection