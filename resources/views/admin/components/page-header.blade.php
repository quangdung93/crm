<div class="page-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{url('/admin')}}"> <i class="feather icon-home"></i> </a>
                    </li>
                    @if(Str::contains($routeName, ['/create','/edit/','/builder/']))
                        <li class="breadcrumb-item">
                            @php
                                $splitRoute = explode('/', $routeName);
                            @endphp
                            <a href="{{url($splitRoute[0].'/'.$splitRoute[1])}}">{{ $pageName }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span style="font-size:14px;color:#4a6076">
                                @if(Str::contains($routeName, '/create'))
                                    Thêm mới
                                @elseif(Str::contains($routeName, '/edit'))
                                    Sửa
                                @elseif(Str::contains($routeName, '/builder'))
                                    Builder
                                @endif
                            </span>
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{url($routeName)}}">{{ $pageName }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>